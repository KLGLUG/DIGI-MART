import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { RegisterPage } from '../register/register'; 

/**
 * Generated class for the PloginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-plogin',
  templateUrl: 'plogin.html',
})
export class PloginPage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }
  Register() {
    this.navCtrl.push(RegisterPage);
}
  ionViewDidLoad() {
    console.log('ionViewDidLoad PloginPage');
  }

}
