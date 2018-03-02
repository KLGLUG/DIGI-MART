import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams ,Platform} from 'ionic-angular';
import { Geolocation } from '@ionic-native/geolocation';
import { AgmCoreModule } from '@agm/core';

/**
 * Generated class for the MapsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-maps',
  templateUrl: 'maps.html',
})
export class MapsPage {
  location:any;
  

  constructor(public navCtrl: NavController, public navParams: NavParams,private geolocation: Geolocation,public platform:Platform) {
  }
  mapUser(){
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

  ionViewDidLoad() {
    console.log('ionViewDidLoad MapsPage');
  }

}
