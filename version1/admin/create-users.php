<?php

	session_start(['cookie_lifetime' => 86400]);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	



	$servername = "160.153.57.72";
$username = "intecare_user";
$password = "password1";
$dbname = "intecare-rosters";

	function InsertPasswordFull($email, $firstName, $lastName, $pass, $agencyId)
{
	
	global $servername, $username, $password, $dbname;
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$bl = false;

	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	} 		
	
	//$salted_password = md5('c6d79930875cdaa4462337b7263f47e347e07d3e'.$password.'2155209');
	$salted_password = password_hash($pass, PASSWORD_DEFAULT);
	echo "submitted password is $pass <br/>";
	echo "creating password as $salted_password";
	$sql = "INSERT INTO `employee-login` (`email`, `password`, `FirstName`, `LastName`, `agencyID`) VALUES ('" . strtolower($email) . "', '" . $salted_password . "', '" . $firstName . "', '" . $lastName . "', " . $agencyId . ")";

	if ($conn->query($sql) === TRUE) 
	{
		$conn->close();
	    return true;
	} 
	else 
	{
		$conn->close();
	    return false;
	}
	
}


echo "<br/>" . InsertPasswordFull('ajenkins@adultandchild.org','Anita','Jenkins','DenmarkSureEnough','429');
echo "<br/>" . InsertPasswordFull('mlong@adultandchild.org','Mary','Long','HeardSettleTried','429');
echo "<br/>" . InsertPasswordFull('glovell@amethysthouse.org','Gina','Lovell','ShoutDuckKnew','1279');
echo "<br/>" . InsertPasswordFull('Craig.Baird@aspireindiana.org','Craig','Baird','PublicLanguageSomeone','430');
echo "<br/>" . InsertPasswordFull('david.wildman@aspireindiana.org','David','Wildman','FractionFiftyVillage','430');
echo "<br/>" . InsertPasswordFull('melissa.dodge@aspireindiana.org','Melissa','Dodge','MainSurpriseBeyond','430');
echo "<br/>" . InsertPasswordFull('Jay.Baumgartner@BowenCenter.org','Jay','Baumgartner','GrowBottomValley','423');
echo "<br/>" . InsertPasswordFull('Anita.Johnson@bowencenter.org','Anita','Johnson','PresentArticleSorry','423');
echo "<br/>" . InsertPasswordFull('mbechtel@mhai.net','Melissa','Bechtel','BetterWesternDiscover','990');
echo "<br/>" . InsertPasswordFull('sherry.barker@centerstone.org','Sherry','Barker','TalkDeadCarry','431');
echo "<br/>" . InsertPasswordFull('Kelly.Stewart@cmhcinc.org','Kelly','Stewart','CowsColorStudent','413');
echo "<br/>" . InsertPasswordFull('Donna.Ross@meridianhs.org','Donna','Ross','ToolsBringDecided','422');
echo "<br/>" . InsertPasswordFull('eborders@cumminsbhs.org','Beth','Borders','PeruMatterFull','428');
echo "<br/>" . InsertPasswordFull('drandolph@edgewatersystems.org','Dianne','Randolph','WhiteBeforeRoot','421');
echo "<br/>" . InsertPasswordFull('loric@familiesfirstindiana.org','Lori','Clyne','AnimalSpeakFamily','839');
echo "<br/>" . InsertPasswordFull('DElliott@fourcounty.org','Diana','Elliott','YourselfStickThrew','427');
echo "<br/>" . InsertPasswordFull('dcarson@ecommunity.com','Deb','Carson','FootStarDusk','416');
echo "<br/>" . InsertPasswordFull('darlene.spencer@geminus.org','Darlene','Spencer','MoonReasonProduce','999');
echo "<br/>" . InsertPasswordFull('Kim.Strasser@cornerstone.org','Kim','Strasser','SpotIndustryAlthough','414');
echo "<br/>" . InsertPasswordFull('Sarah.Persinger@cornerstone.org','Sarah','Persinger','StoreAmountOcean','414');
echo "<br/>" . InsertPasswordFull('SCLINE@HamiltonCenter.org','Sherrie','Cline','BelfastYearMachine','405');
echo "<br/>" . InsertPasswordFull('RUTLEY@HamiltonCenter.org  ','Renee','Utley','FifteenMountainKind','405');
echo "<br/>" . InsertPasswordFull('amyg@lifetreatmentcenters.org','Amy','Grill','TogetherPieceDemand','806');
echo "<br/>" . InsertPasswordFull('kathy.colonna@lifespringhealthsystems.org','Kathy','Colonna','MouthGlossaryMight','402');
echo "<br/>" . InsertPasswordFull('Deborah.Hall@eskenazihealth.edu','Deborah','Hall','DeepBackWheat','401');
echo "<br/>" . InsertPasswordFull('cmcintire@nec.org','Carol','McIntire','WashRadioFeed','426');
echo "<br/>" . InsertPasswordFull('rrunkle@nec.org','Renee','Runkle','ObjectEightForeign','426');
echo "<br/>" . InsertPasswordFull('teri.mccreary@oaklawn.org','Teri','McCreary','WildBridgeStep','409');
echo "<br/>" . InsertPasswordFull('anissa.hatch@parkcenter.org','Anissa','Hatch','BrokenStrangeEngine','419');
echo "<br/>" . InsertPasswordFull('ozdraveski@porterstarke.org','Olivia','Ozdraveski','TalkSurpriseBank','418');
echo "<br/>" . InsertPasswordFull('MLechner@ecommunity.com','Mary','Lechner','FieldFarmShout','407');
echo "<br/>" . InsertPasswordFull('Teanna_Johnson@usc.salvationarmy.org','Teanna','Johnson','DeviceSharpLeast','826');
echo "<br/>" . InsertPasswordFull('Belinda_Lau@usc.salvationarmy.org','Belinda','Lau','DublinFinishedWant','826');
echo "<br/>" . InsertPasswordFull('sjordan@gshvin.org','Shannon','Jordan','SingAprilNeck','403');
echo "<br/>" . InsertPasswordFull('mroby@southernhills.org','Mary','Roby','WiseStudyDraw','420');
echo "<br/>" . InsertPasswordFull('tameka.burnett@geminus.org','Tameka','Burnett','CaseStandFarmers','424');
echo "<br/>" . InsertPasswordFull('DantC@Southwestern.org','Connie','Dant','SafetyAlaskaRaise','404');
echo "<br/>" . InsertPasswordFull('anielsen@swansoncenter.org','Andy','Nielsen','DeadGoesDone','410');
echo "<br/>" . InsertPasswordFull('sclendenen@swansoncenter.org','Stephanie','Clendenen','WireOppositeExactly','410');
echo "<br/>" . InsertPasswordFull('nhowell@villages.org','Nick','Howell','VerbSoldExactly','1006');
echo "<br/>" . InsertPasswordFull('dlane@wvamhc.org','Doug','Lane','ThinWhereWrote','415');
echo "<br/>" . InsertPasswordFull('aambrose@ywcancin.org','Amber','Ambrose','ReportWhenDistant','819');


?>