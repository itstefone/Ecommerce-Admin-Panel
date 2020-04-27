<?php 

namespace App\Traits;

trait FlashMessages {




  protected $errorMessages = [];


  protected $infoMessages = [];


  protected $successMessages = [];


  protected $warningMessages = [];



  protected function setFlashMessage($message, $type) {


    $model = 'infoMessage';


    switch($type) {

      case 'info': 
        $model = 'infoMessage';
      break;

      case 'error': 
        $model = 'errorMessage';
      break;


      case 'warning': 
        $model = 'warningMessage';
      break;

      case 'success': 
        $model = 'successMessage';
      break;

      if(is_array($message)) {
        foreach($message as $key => $value) {
          array_push($this->model, $value);
        } 
      }
      else {
        array_push($this->model, $message);
      }
    }
  }



  protected function getFlashMessage() {

    return [
      'error' => $this->errorMessage,
      'info' => $this->infoMessages,
      'warning' => $this->warningMessages,
      'success' => $this->successMessages
    ];
  }


  protected function showFlashMessage() {


      session()->flash('success', $this->successMessages);
      session()->flash('warning', $this->warningMessages);
      session()->flash('error', $this->errorMessages);
      session()->flash('info', $this->infoMessages);

  }
}