<?php

class SettingsFormProvider
{

		public function createUserDetailsForm(){
			$firstNameInput = $this->createFirstNameInput(null);
			$lastNameInput = $this->createLastNameInput(null);
			$emailInput = $this->createEmailInput(null);
			$saveUserDetailsButton = $this->createSaveUserDetailsButton();

			return "<form action='../../processing.php' method='POST'>
                        <span class='title'>User Details</span>
                        $firstNameInput
                        $lastNameInput
                        $emailInput
                        $saveUserDetailsButton
					</form>";
		}
		public function createPasswordForm(){
			$oldPasswordInput = $this->createPasswordInput('oldPass', 'Old Password');
			$newPasswordInput = $this->createPasswordInput('newPass', 'New Password');
			$confirmNewPasswordInput = $this->createPasswordInput('confirmNewPass', 'Confirm New Password');
			$savePasswordButton = $this->createSavePasswordButton();

			return "<form action='../../processing.php' method='POST'>
                        <span class='title'>Update Password</span>
                        $oldPasswordInput
                        $newPasswordInput
                        $confirmNewPasswordInput
                        $savePasswordButton
					</form>";
		}

		private function createFirstNameInput($value){
		    if ($value == null) $value = "";
			return "<div class='form-group mb-3'>
						<input class='form-control' name='fname' type='text' value='$value' placeholder='First Name' required>
					</div>";
		}

		private function createLastNameInput($value){
		    if ($value == null) $value = "";
			return "<div class='form-group mb-3'>
						<input class='form-control' name='lname' type='text' value='$value' placeholder='Last Name' required>
					</div>";
		}
		private function createEmailInput($value){
		    if ($value == null) $value = "";
			return "<div class='form-group mb-3'>
						<input class='form-control' name='email' type='email' value='$value' placeholder='Email' required>
					</div>";
		}
		private function createPasswordInput($name, $placeHolder){
			return "<div class='form-group mb-3'>
						<input class='form-control' name='$name' type='password' placeholder='$placeHolder' required>
					</div>";
		}

        private function createSaveUserDetailsButton(){
	        return"<button type='submit' name='saveDetailsButton' class='btn btn-primary mt-3'>Save</button>";
        }
        private function createSavePasswordButton(){
	        return"<button type='submit' name='savePassword' class='btn btn-primary mt-3'>Save Password</button>";
        }
}