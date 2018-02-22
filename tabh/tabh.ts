import { Component } from '@angular/core';
import { IonicPage, NavController } from 'ionic-angular';
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

 


  constructor(public navCtrl: NavController) {}
  Logout(){
    this.navCtrl.setRoot(LoginPage);
  }

}
