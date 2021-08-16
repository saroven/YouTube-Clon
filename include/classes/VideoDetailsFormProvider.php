<?php

	class VideoDetailsFormProvider
	{
	    private $conn;
	    public function __construct($conn){
	        $this->conn = $conn;
        }
		public function createUploadForm(){
			$fileInput = $this->createFileInput();
			$titeInput = $this->createTitleInput();
			$description = $this->createDescriptionInput();
			$privacyInput = $this->createPrivacyInput();
			$categoriesInput = $this->createCategoryInput();
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
		private function createFileInput(){
			return "<div class='mb-3'>
					  <input class='form-control' name='file' type='file' id='formFile' required>
					</div>";
		}
		private function createTitleInput(){
			return "<div class='form-group mb-3'>
						<input class='form-control' name='title' type='text' placeholder='Title'>
					</div>";
		}
		private function createDescriptionInput(){
			return "<div class='form-group mb-3'>
						<textarea class='form-control' rows='3' name='description' placeholder='Description'></textarea>
					</div>";
		}
		private function createPrivacyInput(){
			return "<div class='form-group mt-3'>
                      <select class='form-control' name='privacy'>
                          <option value='0'>Private</option>
                          <option value='1'>Public</option>
					  </select>
					<div>
					";
		}
		private function createCategoryInput(){
		    $query = $this->conn->prepare("SELECT * FROM categories");
            $query->execute();
            $html = "<div class='form-group mb-3'>
                      <select class='form-control' name='category'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row["name"];
                $id = $row["id"];
                $html.="<option value='$id'>$name</option>";

            }
            $html .= "</select>
					<div>";
            return $html;
        }
        private function createUploadButton(){
	        return"<button type='submit' name='upload' class='btn btn-primary mt-3'>Upload</button>";
        }
	}