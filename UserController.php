<?php

/**
 * Optimiza acciones con los content
 */
class UserController
{
	/* json */
	public $content = [];

	public function __construct($content)
	{
		$this->content = $content;
	}

	/**
	 *  Comprueba si el elemento se repite
	 * @param array $user elemento de content.json
	 * @param string $elem elemento a comparar
	 * @param array $elem_en_uso contiene los elementos usados en uso
	 * @return bool
	 * */
	private function isRepeated(array $user, string $elem, array $elem_en_uso)
	{
		for($i=0; $i < count($this->content); $i++)
		{
			/* Si el perfil es el mismo no verifica */
			if(null !== $this->content[$i]["name"])
			{
				if(strcmp($user["name"], $this->content[$i]["name"]) != 0)
				{
					if(strcmp($user[$elem], $this->content[$i][$elem]) == 0 && in_array($user[$elem], $elem_en_uso))
					{
						return false;
					}
				}
			}
		}
		return true;
	}

	/* Lista con los links de las redes sociales */
	private $social_media = array("whatsapp" => "https://wa.me/", "telegram" => "https://www.t.me/", "discord" => "https://discordapp.com/channels/@me/", "mail" => "mailto:", "google"=>"https://", "linkedin" => "https://www.linkedin.com/in/", "facebook" => "https://facebook.com/", "github" => "https://github.com/", "instagram" => "https://instagram/", "twitter" => "https://twitter.com/", "youtube" => "https://www.youtube.com/user/", "reddit" => "https://www.reddit.com/user/");

	public function getSocialMedia() : array
	{
		return $this->social_media;
	}

	/**
	 * Devuelve la lista de usuarios filtrados
	 * @param string $elem a filtrar
	 * @return array con los elementos filtrados
	 * */
	public function filter(string $elem) : array
	{
		/*  */
		$elem_filtrado = []; $i=0;
		foreach($this->content as $user)
		{
			if($this->isRepeated($user, $elem, $elem_filtrado) != true)
			{
				continue;
			}
			
			/* Colocar en el array el elemento como usado */
			$elem_filtrado[$i] = $user[$elem]; 
			$service[$i] = $user["service"];
			$i++;
		}
		
		return array_combine($elem_filtrado, $service);
	}

	/**
	 * Devuelve los elementos concatenados + un espacio 
	 * @param array $user con todos los elementos
	 * @param array $elem => $tag a seleccionar mas tag del filtro
	 * */
	public function printList(array $user, array $index) : string
	{
		$str .= '<div tag-rate="'.$user["rate"].'" tag="'.str_replace(" ", "", $user["tag"]).'" ';

		foreach ($index as $elem => $key) {
			foreach ($user[$elem] as $value)
			{
				$str .= 'tag-'.$key.'="'. $value.'" ';
			}
		}

		echo $str.'>';
		return '';
	}
}