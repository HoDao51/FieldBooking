<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FieldConflictController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Field::with(['fieldType', 'conflicts.fieldType'])
            ->withoutTrashed()
            ->orderBy('name');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $fields = $query->paginate(8)->withQueryString();

        $allFields = Field::with('fieldType')
            ->withoutTrashed()
            ->orderBy('name')
            ->get();

        return view('admins.field_conflict.index', compact('fields', 'allFields', 'search'));
    }

    public function update(Request $request, Field $sanBong)
    {
        $request->validate([
            'conflict_fields' => 'nullable|array',
            'conflict_fields.*' => 'exists:fields,id',
        ], [
            'conflict_fields.array' => 'Dữ liệu sân liên kết không hợp lệ.',
            'conflict_fields.*.exists' => 'Sân liên kết không tồn tại.',
        ]);

        DB::table('field_conflicts')
            ->where('field_id', $sanBong->id)
            ->orWhere('conflict_field_id', $sanBong->id)
            ->delete();

        if ($request->has('conflict_fields')) {
            foreach ($request->conflict_fields as $conflictFieldId) {
                if ((int) $conflictFieldId === (int) $sanBong->id) {
                    continue;
                }

                DB::table('field_conflicts')->insert([
                    [
                        'field_id' => $sanBong->id,
                        'conflict_field_id' => $conflictFieldId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'field_id' => $conflictFieldId,
                        'conflict_field_id' => $sanBong->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }

        return Redirect::route('sanLienKet.index')->with('success', 'Cập nhật sân liên kết thành công!');
    }
}
