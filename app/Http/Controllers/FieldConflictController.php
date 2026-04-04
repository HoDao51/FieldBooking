<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFieldConflictRequest;
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

        $fields = $query->paginate(4)->withQueryString();

        $allFields = Field::with('fieldType')
            ->withoutTrashed()
            ->orderBy('name')
            ->get();

        return view('admins.field_conflict.index', compact('fields', 'allFields', 'search'));
    }

    public function update(UpdateFieldConflictRequest $request, Field $sanBong)
    {
        DB::table('field_conflicts')
            ->where('field_id', $sanBong->id)
            ->orWhere('conflict_field_id', $sanBong->id)
            ->delete();

        if ($request->has('conflict_fields')) {
            foreach ($request->conflict_fields as $conflictFieldId) {
                if ($conflictFieldId == $sanBong->id) {
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
