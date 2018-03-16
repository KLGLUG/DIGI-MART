import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { LoginPage } from '../login/login';
import { HttpClient } from '@angular/common/http';

/**
 * Generated class for the YourItemsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-your-items',
  templateUrl: 'your-items.html',
})
export class YourItemsPage {
  public items : Array<any> = [];

  constructor(public navCtrl: NavController, public navParams: NavParams,public http   : HttpClient) {
  }
  Logout(){
    this.navCtrl.setRoot(LoginPage);
  }
  ionViewWillEnter() : void
  {
     this.load();
  }
  load() : void
   {
      this.http
      .get('http://localhost/vamsi/itemretrive.php')
      .subscribe((data : any) =>
      {
         console.dir(data);
         this.items = data;
      },
      (error : any) =>
      {
         console.dir(error);
      });
   }


  ionViewDidLoad() {
    console.log('ionViewDidLoad YourItemsPage');
  }

}
