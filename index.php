<?php 
	
	class Man { // base klasa
		private $firstName;
		private $lastName;

		public function __construct($name) {
			$this->firstName = $name;
		}

		public function setFirstName($fname) {
			$this->firstName = $fname;
		}
		
		public function getFirstName() {
			return $this->firstName;
		}

		public function setLastName($lame) {
			$this->lastName = $lname;
		}
		
		public function getLastName() {
			return $this->lastName;
		}
	} // end of Man

	// Zakazi pregled
	interface RegisterExamination {
		public function scheduleExamination($pacient, $pregled);
	}


	class Doctor extends Man implements RegisterExamination {
		public $speciality; // specijalnost

		public $pacients = array();

		public function setSpeciality($spec) {
			$this->speciality = $spec;
		}

		public function getSpeciality() {
			return $this->speciality;
		}

		public function scheduleExamination($pacient, $pregled){  
			$pregled->pacient = $pacient;
		}	 
	} // end of Doctor

	
	class Pacient extends Man {
		public $idNumber; // jmbg
		public $cardNumber; // broj zdrastvenog kartona

		public $doctor;
		public $pregledi = array();


		public function setIdNumber($id) {
			$this->idNumber = $id;
		}

		public function getIdNumber() {
			return $this->idNumber;
		}

		public function setCardNumber($card) {
			$this->cardNumber = $card;
		}

		public function getCardNumber() {
			return $this->cardNumber;
		}

		public function setDoctor($doctor) {
			$this->doctor = $doctor;
		}

		public function getDoctor() {
			return $this->doctor;
		}

		public function doTest($pregled) {
			return $pregled->getResults();
		}
	} // end of Pacient


	class Examination { // base klasa
		private $exDate;
		private $exTime;
		private $pacient;
		public $title;

		public function __construct($title,$date,$time) {
			$this->title = $title;
			$this->exDate = $date;
			$this->exTime = $time;
		}

		public function setPacient($pacient){
			$this->pacient = $pacient; // 95.
		}

		public function getPacient(){
			return $this->pacient;
		}

		public function setExDate($datum){
			$this->exDate = $datum;

		}

		public function getExDate(){
			return $this->exDate;
		}

		public function setExTime($vreme) {
			$this->exTime = $vreme;
		}

		public function getExTime() {
			return $this->exTime;
		}

	} // end of Examination

	// Laboratorijski pregled
	interface LabExamination {
		public function getResults();
	}

	// Krvni Pritisak
	class BloodPressure extends Examination implements LabExamination {
		public $high; // gornja vrednost
		public $low;  // donja vrednost
		public $rate; // puls

		public function getResults() {
			$results = "Vrsta pregleda: " . $this->title . "<br/>Pacijent: " . $this->pacient->getFirstName() . "<br/> Gornja Vrednost: " . $this->high . "<br/> Donja vrednost: " . $this->low . "<br/> Puls: " . $this->rate  . "<br/>";	
			return $results;	
		}

	} // end of BloodPressure

	// Nivo secera u krvi
	class BloodSugarLevel extends Examination implements LabExamination {
		public $level; // vrednost
		public $lastMealTime; // vreme poslednje obroka

		public function getResults(){ 
			$results = "Vrsta pregleda: " . $this->title . "<br/>Pacijent: " . $this->pacient->getFirstName() . "<br/> Vrednost: " . $this->level . "<br/> Vreme poslednjeg obroka: " . $this->lastMealTime  . "<br/>";
			return  $results;
		}
	} // end of BloodSugarLevel

	// Nivo holesterola u krvi
	class BloodCholesterolLevel extends Examination implements LabExamination {
		public $level; // vrednost
		public $lastMealTime; // vreme poslednje obroka

		public function getResults(){ 
			$results = "Vrsta Pregleda: " . $this->title . "<br/>Pacijent: " . $this->pacient->getFirstName() . "<br/> Vrednost: " . $this->level . "<br/> Vreme poslednjeg obroka: " . $this->lastMealTime . "<br/>";
			return  $results;
		}
	} // end of BloodCholesterolLevel

	// 1.
	$milan = new Doctor("Milan");
	// 2.
	$dragan = new Pacient("Dragan");
	// 3.
	$dragan -> setDoctor($milan);
 	
 	// 4.
 	$pregled = new BloodSugarLevel("Nivo Secera", "19/08/2016","11:00");
 	$pregled->level = (double) 4.5;
 	$pregled->lastMealTime = "20:00";

 	$milan -> scheduleExamination($dragan, $pregled);
	

 	// 5.
	$pregled2 = new BloodPressure("Krvni Pritisak","20/08/2016","12:00");
	$pregled2->high = (int) 120;
	$pregled2->low = (int) 70;
	$pregled2->rate = (int) 37;


 	$milan->scheduleExamination($dragan, $pregled2);

 	// 6.
 	$testResult = $dragan->doTest($pregled);
 	echo $testResult;

 	echo "<br/>";
 	// 7.
 	$testResult1 = $dragan->doTest($pregled2);
 	echo $testResult1;


 ?>