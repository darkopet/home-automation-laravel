<?php
    namespace App\Http\Libs;

    use Auth;

    class Rules {
        public function deviceCreateRule() {
            return [
                'name' => ['required', 'string', 'max:30'],
                'pin' => ['required', 'integer','unique:devices,pin'],
                'status' => ['required', 'boolean'],
                'device_type_id' => ['required', 'integer', 'exists:device_types,id'],
            ];
        }
        public function deviceUpdateRule() {
            return [
                'name' => ['required', 'string', 'max:30'],
                'pin' => ['required', 'integer','unique:devices,pin,' . Auth::user()->id],
                'status' => ['required', 'boolean'],
                'device_type_id' => ['required', 'integer', 'exists:device_types,id'],
            ];
        }
        public function deviceTypeCreateRule() {
            return [
                'name' => ['required', 'max:30', 'unique:device_types,name']
            ];
        }
        public function userCredentialsRule() {
            return [
                'email' => ['required', 'max:40', 'unique:users,email', 'email'],
                'password' => ['required', 'min:5']
            ];
        }
    }
?>