<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Throwable;

class PatientService extends BaseService
{
    protected $patient;

    public function __construct()
    {
        $this->patient = new Patient();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $gender = (empty($request->gender)) ? null : trim(strip_tags($request->gender));

        $table = $this->patient;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
                $query2->orWhere('id_no', 'like', '%' . $search . '%');
                $query2->orWhere('dob', 'like', '%' . $search . '%');
                $query2->orWhere('medium_acquisition', 'like', '%' . $search . '%');
            });
        }
        if (!empty($gender)){
            $table = $table->where("gender", $gender);
        }
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        return $this->response(true, 'Successfully get data', $table);
    }

    public function show($id)
    {
        try {
            $result = $this->patient;
            $result = $result->where('id', $id);
            $result = $result->first();

            if (!$result) {
                return $this->response(false, "Data not found");
            }

            return $this->response(true, 'Successfully get data', $result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $id_type = (empty($request->id_type)) ? null : trim(strip_tags($request->id_type));
            $id_no = (empty($request->id_no)) ? null : trim(strip_tags($request->id_no));
            $dob = (empty($request->dob)) ? null : trim(strip_tags($request->dob));
            $address = (empty($request->address)) ? null : trim(strip_tags($request->address));
            $gender = (empty($request->gender)) ? null : trim(strip_tags($request->gender));
            $medium_acquisition = (empty($request->medium_acquisition)) ? null : trim(strip_tags($request->medium_acquisition));

            $create = $this->patient->create([
                'name' => $name,
                'id_type' => $id_type,
                'id_no' => $id_no,
                'dob' => $dob,
                'gender' => $gender,
                'address' => $address,
                'medium_acquisition' => $medium_acquisition,
            ]);

            return $this->response(true, 'Data successfully added', $create);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $id_type = (empty($request->id_type)) ? null : trim(strip_tags($request->id_type));
            $id_no = (empty($request->id_no)) ? null : trim(strip_tags($request->id_no));
            $dob = (empty($request->dob)) ? null : trim(strip_tags($request->dob));
            $address = (empty($request->address)) ? null : trim(strip_tags($request->address));
            $gender = (empty($request->gender)) ? null : trim(strip_tags($request->gender));
            $medium_acquisition = (empty($request->medium_acquisition)) ? null : trim(strip_tags($request->medium_acquisition));

            $result = $this->patient;
            $result = $result->where('id', $id);
            $result = $result->first();

            if (!$result) {
                return $this->response(false, "Data not found");
            }

            $result->update([
                'name' => $name,
                'id_type' => $id_type,
                'id_no' => $id_no,
                'dob' => $dob,
                'gender' => $gender,
                'address' => $address,
                'medium_acquisition' => $medium_acquisition,
            ]);

            return $this->response(true, 'Data successfully changed', $result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->patient;
            $result = $result->where('id', $id);
            $result = $result->first();

            if (!$result) {
                return $this->response(false, "Data not found");
            }

            $result->delete();

            return $this->response(true, 'Data successfully deleted');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
