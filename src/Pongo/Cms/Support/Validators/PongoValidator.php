<?php namespace Pongo\Cms\Support\Validators;

use Illuminate\Validation\Validator as LaravelValidator;

use Config, Media;

class PongoValidator extends LaravelValidator {

	public function validateUniqueFile($attribute, $value, $parameters)
	{
		$file_name = Media::formatFileName($value);

		$upload_path = Config::get('cms::settings.upload_path');

		$folder_name = Media::getFolderName($file_name);

		$file_path = public_path($upload_path . $folder_name . $file_name);
		
		return (file_exists($file_path)) ? false : true;
	}

	public function validateFileSize($attribute, $value, $parameters)
	{
		$max_size = Config::get('cms::settings.max_upload_size') * 1024000;

		return ($value < $max_size) ? true : false;
	}

	public function validateExtMimes($attribute, $value, $parameters)
	{
		$ext = $value;

		$mimes = str_replace(' ', '', Config::get('cms::settings.mimes'));

		$mimes_arr = explode(',', $mimes);

		return (in_array($ext, $mimes_arr)) ? true : false;
	}

	public function validateFileMimes($attribute, $value, $parameters)
	{
		$ext = Media::fileExtension($value);

		$mimes = str_replace(' ', '', Config::get('cms::settings.mimes'));

		$mimes_arr = explode(',', $mimes);

		return (in_array($ext, $mimes_arr)) ? true : false;
	}

	public function validateNotImage($attribute, $value, $parameters)
	{
		return Media::isFile($value);
	}

}