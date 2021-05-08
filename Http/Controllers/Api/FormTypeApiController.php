<?php


namespace Modules\Iforms\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iforms\Transformers\TypeTransformer;

// Entity
use Modules\Iforms\Entities\FormType;

class FormTypeApiController extends BaseApiController
{

  private $formTypes;

  public function __construct(FormType $formTypes)
  {
    parent::__construct();
    $this->formTypes = $formTypes;
  }

  /**
   * GET ITEMS
   *
   * @return mixed
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);
      //Request to Repository
      $dataEntity = $this->formTypes->lists();
      //Response
      $response = ["data" => $dataEntity];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
    } catch (\Exception $e) {
      \Log::error($e->getMessage());
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }


}
