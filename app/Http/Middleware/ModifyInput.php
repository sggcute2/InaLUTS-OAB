<?php
namespace App\Http\Middleware;

use Closure;
use FORMAT;

class ModifyInput
{
    /**
     * Modify Input
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $input = $request->all();

        if (isset($input['_input_type'])) {
          $input_type = $input['_input_type'];
          foreach($input_type as $field => $type){
            if ($request->has($field)) {
              if ($type == 'date') {
                $_POST[$field] =
                $input[$field] = FORMAT::date_from_datepicker($input[$field]);
              }
              if ($type == 'checkbox') {
                $_POST[$field] =
                $input[$field] = '1';
              }
            } else {
              if ($type == 'checkbox') {
                $_POST[$field] =
                $input[$field] = '0';
              }
            }
          }
        }
        $request->replace($input);
        //dd($input);

        return $next($request);
    }
}
