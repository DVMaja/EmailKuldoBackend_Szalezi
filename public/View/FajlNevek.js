import FajlNev from "./FajlNev.js";

class FajlNevek {

    #ujFajl;
    #tomb = [];

    constructor(szuloElem) {
        this.fajlElem = $("#fajlfeltoltes")
        this.#ujFajl = new FajlNev(this.fajlElem);
        this.divElem = szuloElem
        this.fajlElem = this.divElem.children("last-child");
        
        $("#kuldgomb").on("click", () =>{
            console.log("katt");
            this.#esemenyTrigger("kuldes")
        })   
        //this.uploadFile()
        $('#myfile').on('change', (event) => {
            this.fajl(event);
        })

        console.log(this.#tomb)
    }

    uploadFile(){
        $('#myfile').on('change', (event) => {
            this.fajl(event);
        })

        console.log(this.#tomb)
    }

    FajlHozzaad(fajlNev, kod){
        console.log(fajlNev, kod);

        //két azonos kóddal lévő dokumentum nem tölthető fel
        //Megjegyzés: ez nem biztos, hogy jó, mert ha több doksit kell elküldeni, akkor a kód u.a.
        let adat = {fajlNev: fajlNev, kod: kod};
        for (let index = 0; index < this.#tomb.length; index++) {
            if (this.#tomb[index].kod === adat.kod) {
                //ha az adott kód már szerepel, akkor kilépünk a ciklusból
                return
            }

            //Ha a ciklus végére értünk és az adott kód még nem szerepel a tömbben, hozzáadjuk az adatot
            this.#tomb.push(adat);
            
            
        }
        console.log(this.#tomb)
    }

    FajlHozzaad2(fajlNev, kod)
    {
        console.log(fajlNev, kod);
 
        // Két azonos kóddal lévő dokumentum nem tölthető fel.
        /**--------------------------- */
        let adat = {fajlNev: fajlNev, kod: kod};
 
        for (let i = 0; i < this.#tomb.length; i++) {
            if (this.#tomb[i].kod === adat.kod) {
                // Ha az adott kod már szerepel a tömbben, kilépünk a ciklusból
                return;
            }
        }
       
        // Ha a ciklus végére értünk, és az adott kod még nem szerepel a tömbben, hozzáadjuk az adatot
        this.#tomb.push(adat);
        console.log(this.#tomb);
        /**----------------------------- */
 
        // this.#tomb.push({fajlNev: fajlNev, kod: kod});
    }

    getTomb(){
        return this.#tomb;
    }

    fajl(event){
        //console.log(event)
        let fajl = event.target.files;
        console.log(fajl)

        if (fajl.length > 0) {
            for (var i = 0; i < fajl.length; i++) {
                console.log("Fájlnév: " + fajl[i].name);
                console.log("Méret: " + fajl[i].size + " bytes");
                console.log("Típus: " + fajl[i].type);
                
                let fajlneve = fajl[i].name;
                let kod = "";

                if (fajlneve.indexOf("(") > - 1) {
                    
                    let feldolgozottFajl = fajlneve.split(' ')
                    for (let j = 0; j < feldolgozottFajl.length; j++) {
                        if (feldolgozottFajl[j].indexOf("(") > -1) {
                            kod = feldolgozottFajl[j].slice(1, -1);
                        }
                        
                    }
                }
                //this.FajlHozzaad(fajl[i].name, kod)
                this.FajlHozzaad2(fajl[i].name, kod)
            }
        } else {
            console.log("Nincs fájl kiválasztva.")
        }
    }


    #esemenyTrigger(esemenyneve) {
        const esemeny = new CustomEvent("kuldes", { detail: this.#tomb });
        window.dispatchEvent(esemeny);
    }

}

export default FajlNevek;