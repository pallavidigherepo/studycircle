<?php
namespace App\Services\InquiryStatus;

use App\Http\Requests\StoreInquiryStatusRequest;
use App\Http\Requests\UpdateInquiryStatusRequest;
use App\Models\InquiryStatus;
use App\Repositories\Interfaces\InquiryRepositoryInterface;
use Illuminate\Http\Request;

class InquiryStatusService
{

    public function __construct(protected InquiryStatusRepositoryInterface $inquiryStatusRepository) { }

    public function all($request)
    {
        return $this->inquiryStatusRepository->all($request);
    }


    public function create($request)
    {

        return $this->inquiryStatusRepository->create($request);
    }

    public function show(Inquiry $inquiryStatus): mixed
    {
        if (!$inquiryStatus) {
            return false;
        }
        return $this->inquiryRepository->show($inquiryStatus);
    }

    public function update(Request $request, $inquiryStatus)
    {
        return $this->inquiryRepository->update($request, $inquiryStatus);
    }


    public function delete(Inquiry $inquiryStatus)
    {
        return $this->inquiryStatusRepository->delete($inquiryStatus);
    }

}
