import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import {AngularFireAuth} from 'angularfire2/auth';
import { LoginPage } from '../login/login';
import { FormBuilder,FormGroup} from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';




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
private baseURI : string  = "http://localhost/vamsi/updateitems.php";
  
record:any;


 /* public listItems: any;*/

  
  

  constructor(public navCtrl: NavController,private formBuilder:FormBuilder, public http: HttpClient,public navParams: NavParams,private fire:AngularFireAuth,private toast:ToastController) {
    this.record=navParams.get('emails')
    /*this.listItems=[{
    
    }];*/
  
  this.registeritems=this.formBuilder.group({
       nameofitem:[''],
       aq:[''],
       price:[''],
       Weighta:[''],
       piecesa:[''],
       costa:[''],
       Weightb:[''],
       piecesb:[''],
       costb:[''],
       Weightc:[''],
       piecesc:[''],
       costc:[''],
       Weightd:[''],
       piecesd:[''],
       costd:[''],
       Weighte:[''],
       piecese:[''],
       coste:[''],
       Weightf:[''],
       piecesf:[''],
       costf:[''],
       emailf:['this.record'],
       

  });
  }
  submit(){
   
    this.registeritems.reset();
  }

  createEntry(EMAIL : string,weighta:number,piecesa:number,costa:number,weightb:number,piecesb:number,costb:number,weightc:number,piecesc:number,costc:number,weightd:number,piecesd:number,costd:number,weighte:number,piecese:number,coste:number,weightf:number,piecesf:number,costf:number,emailf:string) : void
  {
     let headers 	: any		= new HttpHeaders({ 'Content-Type': 'application/json' }),
         options 	: any		= { "key" : "create", "EMAIL" : EMAIL, "weighta" : weighta,"piecesa":piecesa,"costa":costa, "weightb" : weightb,"piecesb":piecesb,"costb":costb, "weightc" : weightc,"piecesc":piecesc,"costc":costc, "weightd" : weightd,"piecesd":piecesd,"costd":costd, "weighte" : weighte,"piecese":piecese,"coste":coste, "weightf" : weightf,"piecesf":piecesf,"costf":costf,"emailf":emailf },
         url       : any      	= this.baseURI ;

     this.http.post(url, JSON.stringify(options), headers)
     .subscribe((data : any) =>
     {
        // If the request was successful notify the user
     
        console.log(`Congratulations the ${EMAIL} was successfully added`);
        this.registeritems.reset();
     },
     (error : any) =>
     {
        console.log('Something went wrong!');
     });
  }
  saveEntry() : void
  {
     let EMAIL          : string = this.registeritems.controls["nameofitem"].value,
         weighta   : number   = this.registeritems.controls["Weighta"].value,
         piecesa         : number = this.registeritems.controls["piecesa"].value,
         costa:number=this.registeritems.controls["costa"].value,
         weightb   : number   = this.registeritems.controls["Weightb"].value,
         piecesb         : number = this.registeritems.controls["piecesb"].value,
         costb:number=this.registeritems.controls["costb"].value,
         weightc   : number   = this.registeritems.controls["Weightc"].value,
         piecesc         : number = this.registeritems.controls["piecesc"].value,
         costc:number=this.registeritems.controls["costc"].value,
         weightd   : number   = this.registeritems.controls["Weightd"].value,
         piecesd         : number = this.registeritems.controls["piecesd"].value,
         costd:number=this.registeritems.controls["costd"].value,
         weighte   : number   = this.registeritems.controls["Weighte"].value,
         piecese         : number = this.registeritems.controls["piecese"].value,
         coste:number=this.registeritems.controls["coste"].value,
         weightf   : number   = this.registeritems.controls["Weightf"].value,
         piecesf         : number = this.registeritems.controls["piecesf"].value,
         costf:number=this.registeritems.controls["costf"].value,
         emailf:string=this.registeritems.controls["emailf"].value

    
        this.createEntry(EMAIL,weighta,piecesa,costa,weightb,piecesb,costb,weightc,piecesc,costc,weightd,piecesd,costd,weighte,piecese,coste,weightf,piecesf,costf,emailf);
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
