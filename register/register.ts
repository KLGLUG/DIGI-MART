
import { IonicPage, NavController, NavParams ,Platform} from 'ionic-angular';
import { AngularFireAuth } from 'angularfire2/auth';
import { Component ,ViewChild } from '@angular/core';
import { Geolocation } from '@ionic-native/geolocation';




/**
 * Generated class for the RegisterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-register',
  templateUrl: 'register.html',
})
export class RegisterPage {
   @ViewChild('username') user;
   @ViewChild('password') password;
   location:any;

  constructor(private fire: AngularFireAuth,public navCtrl: NavController, public navParams: NavParams,private geolocation: Geolocation,public platform:Platform) {
  }
  

  ionViewDidLoad() {
    console.log('ionViewDidLoad RegisterPage');
  }
  
  async registerUser() {
    const result=this.fire.auth.createUserWithEmailAndPassword(this.user.value,this.password.value)
    .then(result=> {
     console.log('got data',result);
}
)
 .catch(error=>{
     console.log('got error',error);
});
   this.platform.ready().then(()=>{
    let options={timeout:3000,enableHighAccuracy:true,maximumAge:0}
this.geolocation.getCurrentPosition(options).then((location) => {
  console.log('Fetched the location successfully',location);
  this.location=location;
}).catch((error) => {
  console.log('Error getting location', error);
});
});
}
}
