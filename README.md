# PHP-MySQL-Firebase
This is simple bootstrap web site written by php.

![Sceenshot](images/screen0.png)
![Sceenshot](images/screen1.png)

It uses MySql and Firebase.
Firebase supports Android , iOS and Unity, React but not Php.
So, It needs to use the Php Firebase Admin SDK for access the firebase via php.

I used the PHP Firebase Admin SDK to read/write the data from Firebase.
This is no laravel but pure php web site.

- create firebase project 

- Install the PHP Firebase Admin SDK in your console
  $ composer require kreait/firebase-php
  
- Add the authentication json to your project 
  (how to get the authentication json file? please lookat this video https://www.youtube.com/watch?v=3ACxp56r7ag)
  
- how to connect to firebase realtime db <br>
  require_once __DIR__ . '/vendor/autoload.php';<br>
  
  use Kreait\Firebase\Factory; <br>
  use Kreait\Firebase\ServiceAccount; <br>
  
  //. get reference to firebase realtime database <br>
  $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/groupmsgapp-4507d-c26e80f7117a.json'); // add the authentication file to your php project <br>
  $firebase = (new Factory)->withServiceAccount($serviceAccount)->create(); <br>
  $this->database = $firebase->getDatabase(); <br>
  
  //. read child <br>
  $reference = $this->database->getReference($this->db_group) <br>
  $snapshotGroup = $reference->getSnapshot();  <br>
  $groups = $snapshotGroup->getValue();  <br>
  
  //. write child <br>
  $data = array(); <br>
  $data["name"] = $group;   <br>
  $path = $this->db_group.'/'.$custom_child; <br>
  $reference = $this->database->getReference($path); <br>
  $postKey= $reference->push($data); <br>
  
  //. remove child and subchild <br>
  $reference = $this->database->getReference($path); <br>
  $reference->remove(); <br>
  
You can see the more details via https://firebase-php.readthedocs.io/en/stable/setup.html <br>

Enjoy it. 
 
