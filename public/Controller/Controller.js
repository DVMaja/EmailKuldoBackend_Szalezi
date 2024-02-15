import FajlNevek from "../View/FajlNevek.js";
import DataService from "../Modell/DataService.js";

const ALAPVEGPONT = "api/mail_senders";
class Controller {
    constructor() {
        const szuloElem = $("#tarolo")
        const FAJLNEVEK = new FajlNevek(szuloElem);
        this.dataService = new DataService();
        const tombom = FAJLNEVEK.getTomb();
        const gombElem = $("kuldgomb")

        $(window).on("kuldes", (event) =>{
            for (let index = 0; index < event.detail.length; index++) {
                this.dataService.postAxiosData('/api/mail_senders', event.detail[index])
                
            }
        })


        let index = 0;
    
        function sendNextRequest() {
            if (index < tombom.length) {
                console.log("while ciklus?");
                this.dataService.postAxiosData("/mail_senders", {
                    student_id: this.detail[index].kod,
                    pdf_name: this.detail[index].fajlNev,
                }).then(() => {
                    console.log("Az adat sikeresen elküldve!");
                    index++;
                    sendNextRequest(); // Rekurzív hívás a következő kérés elküldéséhez
                }).catch(error => {
                    console.error("Hiba történt az adatküldés során:", error);
                    // Opcionális: kezeljük a hibát, például újra küldés vagy naplózás
                });
            }
        }
    
        sendNextRequest(); 
        

         
/*
        if (gombElem) {
            $(window).on("kuldes", (event) =>{
                console.log("Ifen belülbelépünk ide egyáltalán?")
                this.dataService.postAxiosData("/mail_senders", {
                    
                    student_id : event.detail[i].kod,
                    pdf_name: event.detail[i].fajlNev,
                }); 
            })    
        } else {
            console.log("Nincs kiválasztva fájl!")
        }
*/

    $(window).on("kuldes", (event) =>{
        console.log("belépünk ide egyáltalán?")
        console.log(event.detail);
        //sendNextRequest(tombom, event.detail);
    })


/*
        $(window).on("kuldes", () =>{
            console.log("belépünk ide egyáltalán?")
            for (let index = 0; index < tombom.length; index++) {
                console.log(tombom[index])
                console.log("belépünk ide egyáltalán?")
                this.dataService.postAxiosData("/mail_senders", {
                    
                    student_id : this.detail[index].kod,
                    pdf_name: this.detail[index].fajlNev,
                }); 
            }
            /*
            //console.log("küldés :)");
            //console.log(event.detail);
            //$("#tarolo").html(event.detail)

            //this.dataService.getAxiosData("api/students", this.megjelenit);
            this.dataService.postAxiosData("api/mail_senders", FAJLNEVEK.getTomb())
           
            for (let index = 0; index < event.detail.length; index++) {
                //$("#fajlfeltoltes").append(event.detail[i].fajlNev, event.detail[i].kod);
                let adatok = FAJLNEVEK.getTomb();
                //this.dataService.postAxiosData("/mail_senders", adatok)
                this.dataService.putAxiosData("/mail_senders", index, adatok)
                console.log("For cikluson belül vagyunk")
                this.dataService.postAxiosData("/mail_senders", {
                    
                    student_id : event.detail[i].kod,
                    pdf_name: event.detail[i].fajlNev,
                });            
                
            }
            */
            //this.dataService.getAxiosData("api/mail_senders", this.megjelenit);
                

        
        
    }
    
    megjelenit(list){
        console.log(list);
    }

    sendNextRequest(tombom, event) {
        let index = 0;
        if (index < tombom.length) {
            console.log("while ciklus?");
            this.dataService.postAxiosData("/mail_senders", {
                student_id: event.detail[index].kod,
                pdf_name: event.detail[index].fajlNev,
            }).then(() => {
                console.log("Az adat sikeresen elküldve!");
                index++;
                sendNextRequest(); // Rekurzív hívás a következő kérés elküldéséhez
            }).catch(error => {
                console.error("Hiba történt az adatküldés során:", error);
                // Opcionális: kezeljük a hibát, például újra küldés vagy naplózás
            });
        }
    }

}

export default Controller;