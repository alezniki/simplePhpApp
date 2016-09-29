<?php 
	
	class Man { // base class for Doctor and Patient
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

	// Schedule examination
	interface RegisterExamination {
		public function scheduleExamination($patient, $exam);
	}

	// Doctor has first name, last name and speciality
	class Doctor extends Man implements RegisterExamination {
		public $speciality;

		public $patients = array();

		public function setSpeciality($spec) {
			$this->speciality = $spec;
		}

		public function getSpeciality() {
			return $this->speciality;
		}

		public function scheduleExamination($patient, $exam){  
			$exam->patient = $patient;
		}	 
	} // end of Doctor

	// Patient has first name, last name, identification number and examination ssnumber
	class Patient extends Man {
		public $idNumber; // personal identification number
		public $cardNumber; // medical examination number

		public $doctor;
		public $examinations = array();


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

		public function doTest($exam) {
			return $exam->getResults();
		}
	} // end of Patient


	class Examination { // base class for Examinations
		private $exDate;
		private $exTime;
		private $patient;
		public $title;

		public function __construct($title,$date,$time) {
			$this->title = $title;
			$this->exDate = $date;
			$this->exTime = $time;
		}

		public function setPatient($patient){
			$this->patient = $patient;
		}

		public function getPatient(){
			return $this->patient;
		}

		public function setExDate($dateOfEx){
			$this->exDate = $dateOfEx;

		}

		public function getExDate(){
			return $this->exDate;
		}

		public function setExTime($timeOfEx) {
			$this->exTime = $timeOfEx;
		}

		public function getExTime() {
			return $this->exTime;
		}

	} // end of Examination

	// Laboratory exam
	interface LabExamination {
		public function getResults();
	}

	// Blood Pressure
	class BloodPressure extends Examination implements LabExamination {
		public $high; // high blood pressure
		public $low;  // high blood pressure
		public $rate; // heart rate

		public function getResults() {
			$results = "Type of Examination: " . $this->title . "<br/>Patient: " . $this->patient->getFirstName() . "<br/> Hypertension value: " . $this->high . "<br/> Hypotension value: " . $this->low . "<br/> Heart rate: " . $this->rate  . "<br/>";	
			return $results;	
		}

	} // end of BloodPressure

	// Sugar level
	class BloodSugarLevel extends Examination implements LabExamination {
		public $level; // level
		public $lastMealTime; // time of last meal

		public function getResults(){ 
			$results = "Type of Examination: " . $this->title . "<br/>Patient: " . $this->patient->getFirstName() . "<br/> Level: " . $this->level . "<br/> Time of last meal: " . $this->lastMealTime  . "<br/>";
			return  $results;
		}
	} // end of BloodSugarLevel

	// Cholesterol level
	class BloodCholesterolLevel extends Examination implements LabExamination {
		public $level;  // level
		public $lastMealTime; // time of last meal

		public function getResults(){ 
			$results = "Type of Examination: " . $this->title . "<br/>Patient: " . $this->patient->getFirstName() . "<br/> Level: " . $this->level . "<br/> Time of last meal: " . $this->lastMealTime . "<br/>";
			return  $results;
		}
	} // end of BloodCholesterolLevel

	// 1.Create Doctor, for Example "Milan"
	$milan = new Doctor("Milan");

	// 2.Create Patient, for Example "Dragan"
	$dragan = new Patient("Dragan");
	
	//  3.Patient "Dragan" can choose doctor "Milan"
	$dragan -> setDoctor($milan);
 	
 	// 4.Doctor "Milan" appoints blood pressure examination for patient "Dragan"
 	$exam = new BloodSugarLevel("Sugar Level", "19/08/2016","11:00");
 	$exam->level = (double) 4.5;
 	$exam->lastMealTime = "20:00";

 	$milan -> scheduleExamination($dragan, $exam);
	

 	// 5.Doctor "Milan" appoints blood sugar level examination for patient "Dragan"
	$exam2 = new BloodPressure("Blood Pressure","20/08/2016","12:00");
	$exam2->high = (int) 120;
	$exam2->low = (int) 70;
	$exam2->rate = (int) 37;


 	$milan->scheduleExamination($dragan, $exam2);

 	// 6.Patient "Dragan" takes blood sugar level examination
 	$testResult = $dragan->doTest($exam);
 	echo $testResult;

 	echo "<br/>";
 	// 7.Patient "Dragan" takes blood pressure examination
 	$testResult1 = $dragan->doTest($exam2);
 	echo $testResult1;


 ?>