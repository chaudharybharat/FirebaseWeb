<html>
<body>
<div id="demo"></div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-auth.js"></script>
<!-- <script src="/__/firebase/init.js"></script> -->
<script>
var POST_TABLE="post";
var COMMENT_TABLE="comment"
var SIGNUP_TABLE="user"
 // const firebase = require("firebase");
  // Your web app's Firebase configuration
  var firebaseConfig = {

    apiKey: "AIzaSyDXhL5CLQW4pbC0463imTzoIxTpg_Wh7f4",
    authDomain: "test-b7001.firebaseapp.com",
    databaseURL: "https://test-b7001.firebaseio.com",
    projectId: "test-b7001",
    storageBucket: "test-b7001.appspot.com",
    messagingSenderId: "952594071382",
    appId: "1:952594071382:web:d4ecb00332b3fadbf460f7",
    measurementId: "G-XYEQ3SLZZH"

    // apiKey: "AIzaSyArBp9bI9LdVt4SpJPZQdTdUsIYlUiba5s",
    // authDomain: "jshealth-729d2.firebaseapp.com",
    // databaseURL: "https://jshealth-729d2.firebaseio.com",
    // projectId: "jshealth-729d2",
    // storageBucket: "jshealth-729d2.appspot.com",
    // messagingSenderId: "886031897970",
    // appId: "1:886031897970:web:5b493a410d3c844cfe39eb",
    // measurementId: "G-FX3D6F9QZ4"
  };
  // Required for side-effects
  firebase.initializeApp(firebaseConfig) 
     var db = firebase.firestore();
    creatauthentication("bhara7572@gmail.com","2242242");
    loginFirebase("bharat2@gmail.com","2242242");
    setUserDetail();
   //  creatPost();
   //  creatComment();
     getUserDetail();
    getPostData();
    getCommentData();



    <!-- -------------------authentication user -------------------------- -->

    function creatauthentication(email,password){
 
      firebase.auth().createUserWithEmailAndPassword(email,password)
  .then(data => {console.log('Signup  successfully'+data); })
  .catch(error => {
     switch (error.code) {
        case 'auth/email-already-in-use':
          console.log(`Email address ${email} already in use.`);
        case 'auth/invalid-email':
          console.log(`Email address ${email} is invalid.`);
        case 'auth/operation-not-allowed':
          console.log(`Error during sign up.`);
        case 'auth/weak-password':
          console.log('Password is not strong enough. Add additional characters including special characters and numbers.');
        default:
          console.log(error.message);
      }
  });
    }
 <!-- -------------------login firebase -------------------------- -->

    function loginFirebase(email,password){
        firebase.auth().signInWithEmailAndPassword(email, password)
        .then(data => {console.log('Login  successfully'+data); })
        .catch(function(error) {
          // Handle Errors here.
          var errorCode = error.code;
          var errorMessage = error.message;
          // [START_EXCLUDE]
          if (errorCode === 'auth/wrong-password') {
        
            console.log('Wrong password.')
          } else {
            console.log('User not found =>'+errorMessage)
          }
          console.log('Login error =>'+error)
          // [END_EXCLUDE]
        });
    }
    

<!-- -----------------------getUser Detail ----------------- -->

   function getUserDetail(){

 //   all user get list
    db.collection(SIGNUP_TABLE).get()
    .then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
            // doc.data() is never undefined for query doc snapshots
            console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });


    //    where condition particular user via 
    db.collection(SIGNUP_TABLE).where("first_name","==" ,"bharat")
                .onSnapshot(function(snapshot) {
                    console.log("Current users born before 1900:");
                    snapshot.forEach(function (userSnapshot) {
                        console.log(userSnapshot.data())
                        console.log(userSnapshot.get("first_name"))
                    });
                });

//                 db.collection("user").get().then((querySnapshot) => {
//     querySnapshot.forEach((doc) => {
//         console.log(`${doc.id} => ${doc.data()}`);
//     });
// });
     
    }
<!-- --------------------------get Post data ----------------- -->
function getPostData(){
   
    db.collection(POST_TABLE).get()
    .then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
            // doc.data() is never undefined for query doc snapshots
            console.log("post Data=>"+doc.id, " => ", doc.data());  
        });  
 
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
}

<!-- --------------------------get Commenet data ----------------- -->
function getCommentData(){
   
   db.collection(COMMENT_TABLE).where("post_id","==" ,"0").get()
   .then(function(querySnapshot) {
       querySnapshot.forEach(function(doc) {
           // doc.data() is never undefined for query doc snapshots
           console.log("Comment =>>"+doc.id, " => ", doc.data());
          
       });
    

   })
   .catch(function(error) {
       console.log("Error getting documents: ", error);
   });
}
<!-- --------------------------set UserDetail ----------------- -->
                function setUserDetail(){
                    try{
  
                   db.collection(SIGNUP_TABLE).doc("4").set({
                            first_name: "Jk",
                            last_name: "chaudhary",
                             mobile: "80062962",
                            profile: "https://i.ibb.co/4gRmCjj/images-2.jpg"
                        })
                        .then(function(docRef) {
                         console.log("Document written with ID: ", docRef.id);
                        })
                          .catch(function(error) {
                         console.log("Error adding document: ", error);
                     });
                     }catch(error){
                      console.log("errro========",error);
                     }
                }
  <!-- ---------------------------creatPost --------------------------------------------- -->    
                function creatPost(){
                    try{

                   db.collection(POST_TABLE).add({
                        "description":"bharat",
                        "is_read": "",
                        "tag": "js",
                        "total_comment" : "0",
                        "title":"Android developer",
                        "time" :"15855285",
                        "user_id_fk":"3"
                        })
                        .then(function(docRef) {
                         console.log("Document written with ID: ", docRef.id);
                        })
                          .catch(function(error) {
                         console.log("Error adding document: ", error);
                     });
                     }catch(error){
                      console.log("errro========",error);
                     }
                }
  <!-- ----------------------------creatComment --------------------------------------------- --> 
       
                function creatComment(){
                    try{

                   db.collection(COMMENT_TABLE).add({
                        "comment":"Hello how are you",
                        "time": "15852525",
                        "tag": "js",
                        "post_id" : "0", 
                        "user_id_fk":"3"
                        })
                        .then(function(docRef) {
                         console.log("Document written with ID: ", docRef.id);
                        })
                          .catch(function(error) {
                         console.log("Error adding document: ", error);
                     });
                     }catch(error){
                      console.log("errro========",error);
                     }
                }

<!-- ---------------------signOut --------------------------------------------- -->
          function signOut(){
              firebase.auth().signOut().then(function() {
             // Sign-out successful.
                }).catch(function(error) {
            // An error happened.
                });
          }    
</script>
<!-- <?php
echo "<table style='width:100%'>
<tr>
  <th>Firstname</th>
  <th>Lastname</th>
  <th>mobile</th>
  <th>profile</th>
</tr>
<tr align='center'>
  <td >Jill</td>
  <td>Smith</td>
  <td>9859595959</td>
  <td><img src='https://i.ibb.co/4f92BFM/images.jpg' alt='Italian Trulli'  height='42' width='42'/></td>
</tr>
<tr align='center'>
  <td>Eve</td>
  <td>Jackson</td>
  <td>9859595959</td>
  <td><img src='https://i.ibb.co/4f92BFM/images.jpg' alt='Italian Trulli'  height='42' width='42'/></td>
</tr>

</table>

"
?> -->

</body>
</html>