import { Component } from '@angular/core';
import { IonicPage, NavController,NavParams, AlertController } from 'ionic-angular';
import { LoginPage } from '../login/login';

/**
 * Generated class for the TabhPage tabs.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-tabh',
  templateUrl: 'tabh.html'
})
export class TabhPage {

  homeRoot = 'HomePage'
  yourItemsRoot = 'YourItemsPage'
  editHistoryRoot = 'EditHistoryPage'
 record:any;
 


  constructor(public navCtrl: NavController,private alertCtrl: AlertController,public navParams: NavParams) {
    this.record=navParams.get('emails')
  }
  Logout(){
    let alert = this.alertCtrl.create({
      title: 'CONFIRM LOGOUT',
      message: 'Do you want to Logout',
      buttons: [
        {
          text: 'stay',
          role: 'cancel',
          handler: () => {
            console.log('Cancel clicked');
            this.navCtrl.setRoot(TabhPage);
          }
        },
        {
          text: 'Logout',
          handler: () => {
            console.log('Buy clicked');
            this.navCtrl.setRoot(LoginPage);
          }
        }
      ]
    });
    alert.present();
  }
  }


