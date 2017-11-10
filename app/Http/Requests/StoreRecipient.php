<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use App\Recipient;

use App\Http\Requests\FormRequest;

class StoreRecipient extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $uniqueRule = '';

    switch($this->method()) {
      case 'PUT': {
        $recipient = Recipient::find($this->recipients);
        $path = explode('/' ,$this->path());
        $uniqueRule = Rule::unique('recipients')->ignore($path[2]);
        break;
      }
      case 'POST' : {
        $uniqueRule = Rule::unique('recipients');
        break;
      }
    }
    return [
      'name' => 'required|max:255',
      'email' => [
        'required',
        'max:255',
        'email',
        $uniqueRule
      ]
    ];
  }
}
