import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import {AngularFireAuth} from 'angularfire2/auth';
import { LoginPage } from '../login/login';
import { FormBuilder,FormGroup} from '@angular/forms';




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

  registeritems:FormGroup;
  public isKgsSelected: boolean;
public isPiecesSelected: boolean;
  
  



 /* public listItems: any;*/

  
  

  constructor(public navCtrl: NavController,private formBuilder:FormBuilder, public navParams: NavParams,private fire:AngularFireAuth,private toast:ToastController) {
    /*this.listItems=[{

    }];*/
  
  this.registeritems=this.formBuilder.group({
       nameofitem:[''],
       aq:[''],
       price:[''],
       Weight1:[''],
       pieces1:[''],
       cost1:[''],
       Weight2:[''],
       pieces2:[''],
       cost2:[''],
       Weight3:[''],
       pieces3:[''],
       cost3:[''],
       Weight4:[''],
       pieces4:[''],
       cost4:[''],
       Weight5:[''],
       pieces5:[''],
       cost5:[''],
       Weight6:[''],
       pieces6:[''],
       cost6:[''],
       

  });
  }
  submit(){
   
    this.registeritems.reset();
  }
 /*public additem():void{
     this.listItems.push({
       name: "vamsi",
       value: 1
     });
 }*/
 
 selectItem(Mode)
 {
     if(Mode == 'Kgs')
     {
         this.isPiecesSelected = false;
         this.isKgsSelected = true;
     }
     else if(Mode == 'Pieces')
     {
         this.isKgsSelected = false;
         this.isPiecesSelected = true;
     }
 }


 
 cancel()
 {
     this.isKgsSelected = false;
     this.isPiecesSelected = false;
 }
  Logout(){
    this.navCtrl.setRoot(LoginPage);
  }
  

  ionViewWillLoad() {
    this.isKgsSelected = false;
    this.isPiecesSelected = false;
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
