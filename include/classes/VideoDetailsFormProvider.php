<?php

	class VideoDetailsFormProvider
	{
	    private $conn;
	    public function __construct($conn){
	        $this->conn = $conn;
        }
		public function createUploadForm(){
			$fileInput = $this->createFileInput();
			$titeInput = $this->createTitleInput(null);
			$description = $this->createDescriptionInput(null);
			$privacyInput = $this->createPrivacyInput(null);
			$categoriesInput = $this->createCategoryInput(null);
			$uploadButton = $this->createUploadButton();
			return "<form action='../../processing.php' method='POST' enctype='multipart/form-data'>
						$fileInput
						$titeInput
						$description
						$categoriesInput
						$privacyInput
						$uploadButton
					</form>";
		}
		public function createEditDetailsForm($video){
			$titleInput = $this->createTitleInput($video->getTitle());
			$description = $this->createDescriptionInput($video->getDescription());
			$privacyInput = $this->createPrivacyInput($video->getPrivacy());
			$categoriesInput = $this->createCategoryInput($video->getCategory());
			$saveButton = $this->createSaveButton();
			return "<form method='POST'>
						$titleInput
						$description
						$categoriesInput
						$privacyInput
						$saveButton
					</form>";
		}
		private function createFileInput(){
			return "<div class='mb-3'>
					  <input class='form-control' name='file' type='file' id='formFile' required>
					</div>";
		}
		private function createTitleInput($value){
	            $value ?? $value = "";
			return "<div class='form-group mb-3'>
						<input class='form-control' name='title' value='$value' type='text' placeholder='Title'>
					</div>";
		}
		private function createDescriptionInput($value){
	        $value ?? $value = "";
			return "<div class='form-group mb-3'>
						<textarea class='form-control' rows='3' value='$value' name='description' placeholder='Description'>$value</textarea>
					</div>";
		}
		private function createPrivacyInput($value){
	        $value ?? $value = "";
	        $privateSelected = ($value == 0) ? "selected='selected'" : "";
	        $publicSelected = ($value == 1) ? "selected='selected'" : "";
			return "<div class='form-group mt-3'>
                      <select class='form-control' name='privacy'>
                          <option value='0' $privateSelected>Private</option>
                          <option value='1' $publicSelected>Public</option>
					  </select>
					<div>
					";
		}
		private function createCategoryInput($value){
	        $value ?? $value = "";
		    $query = $this->conn->prepare("SELECT * FROM categories");
            $query->execute();
            $html = "<div class='form-group mb-3'>
                      <select class='form-control' name='category'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row["name"];
                $id = $row["id"];
                $selected = ($id == $value) ? "selected='selected'" : "";
                $html.="<option $selected value='$id'>$name</option>";

            }
            $html .= "</select>
					<div>";
            return $html;
        }
        private function createUploadButton(){
	        return"<button type='submit' name='upload' class='btn btn-primary mt-3'>Upload</button>";
        }
        private function createSaveButton(){
	        return"<button type='submit' name='saveButton' class='btn btn-primary mt-3'>Save</button>";
        }
	}