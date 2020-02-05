<?php 
class Library extends AbstractEntity {
	private $name;
	private $category;
	private $subcategory;
	private $season;
	private $smax;
	private $episode;
	private $epmax;
	private $tag;
	private $evaluation;
	private $note;
	private $userid;
	private $like;

	public function __construct($name,$category,$subcategory,$season,$smax,$episode,$epmax,$tag,$evaluation,$note,$userid){
		$this->name = $name;
		$this->category = $category;
		$this->subcategory = $subcategory;
		$this->season = $season;
		$this->smax = $smax;
		$this->episode = $episode;
		$this->epmax = $epmax;
		$this->tag = $tag;
		$this->evaluation = $evaluation;
		$this->note = $note;
		$this->userid = $userid;
	 }

	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getCategory() {
		return $this->category;
	}
	public function setCategory($category) {
		$this->category = $category;
	}
	public function getsubcategory() {
		return $this->subcategory;
	}
	public function setSubcategory($subcategory) {
		$this->subcategory = $subcategory;
	}
	public function getSeason() {
		return $this->season;
	}
	public function setSeason($season) {
		$this->season = $season;
	}
	public function getSmax() {
		return $this->smax;
	}
	public function setSmax($smax) {
		$this->smax = $smax;
	}
	public function getEpisode() {
		return $this->episode;
	}
	public function setEpisode($episode) {
		$this->episode = $episode;
	}
	public function getEpmax() {
		return $this->epmax;
	}
	public function setEpmax($epmax) {
		$this->epmax = $epmax;
	}
	public function getTag() {
		return $this->tag;
	}
	public function setTag($tag) {
		$this->tag = $tag;
	}
	public function getEvaluation() {
		return $this->evaluation;
	}
	public function setEvaluation($evaluation) {
		$this->evaluation = $evaluation;
	}
	public function getNote() {
		return $this->note;
	}
	public function setNote($note) {
		$this->note = $note;
	}
	public function getUserId() {
		return $this->userid;
	}
	public function setUserId($userid) {
		$this->userid = $userid;
	}

	public function getLike()
	{
		return $this->like;
	}

	public function setLike($like) {
		$this->like = $like;
	}

} 
 ?>