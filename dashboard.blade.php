

<a href="{{route('logout') }}">logout</a>
  <?php

foreach($doctordetail as $n=>$doctordetails)
{
	$dc=DB::table('users')
	      ->where('account_type',1)
		  ->get();
		   $doctordetail[$n]->docdetails=$dc;
	
}

echo "<pre>";
print_r($doctordetail);
exit;

?>