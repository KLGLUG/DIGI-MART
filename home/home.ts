import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import {AngularFireAuth} from 'angularfire2/auth';

/**
 * Generated class for the HomePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-home',
  templateUrl: 'home.html',
})
export class HomePage {

  constructor(public navCtrl: NavController, public navParams: NavParams,private fire:AngularFireAuth,private toast:ToastController) {
    
  }

  ionViewWillLoad() {
    this.fire.authState.subscribe(user=>{
      if(user && user.email && user.uid){
      this.toast.create({
         message:'Successfully logged into Digimart',
         duration:3000
      }).present();
    }
    else{
      this.toast.create({
        message:'User name or Password not matched',
        duration:3000
     }).present();
  }
  })

}
}
