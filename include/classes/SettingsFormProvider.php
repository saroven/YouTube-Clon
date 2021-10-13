<?php

class SettingsFormProvider
{

		public function createUserDetailsForm(){
			$firstNameInput = $this->createFirstNameInput(null);
			$lastNameInput = $this->createLastNameInput(null);
			$emailInput = $this->createEmailInput(null);
			$saveUserDetailsButton = $this->createSaveUserDetailsButton();

			return "<form action='../../processing.php' method='POST'>
                        $firstNameInput
                        $lastNameInput
                        $emailInput
                        $saveUserDetailsButton
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

        private function createSaveUserDetailsButton(){
	        return"<button type='submit' name='saveDetailsButton' class='btn btn-primary mt-3'>Save</button>";
        }
}