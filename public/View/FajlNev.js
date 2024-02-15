class FajlNev {

    constructor(szuloElem) {
        this.divElem = szuloElem
        this.fajlElem = this.divElem.children(":last-child");
        this.#megjelenit()
    }

    #megjelenit() {
        let txt = "";
        txt += `<span class="kivalaszt"><input type="file" id="myfile" name="myfile" multiple>`
        txt += `</span><input type="submit" value="Küldés" id="kuldgomb">`
        this.divElem.append(txt);
    }

    fajlnev() {
        $("#myfile").change(function (event) {
            //console.log(event.target.files[0].name)
            let fajlneve = (event.target.files[0].name)
            const feldolgozottFajl = fajlneve.split(' ')
            console.log(fajlneve)
            let kod = "";
            //ez végig fut a keletkezett tömbön, ami a 'feldolgozottFajl'
            for (let index = 0; index < feldolgozottFajl.length; index++) {
                //itt megnézi, hogy az adott elem tartalmazza-e a karaktert
                //bízunk benne, hogy mindenkinek az egyedi kódja lesz csak zárójelben :D
                if (feldolgozottFajl[index].indexOf("(") > -1) {
                    //console.log(feldolgozottFajl[index])
                    //slice-al levesszük a zárójelet miután megtaláltuk
                    kod += feldolgozottFajl[index].slice(1, -1)
                }

            }
            $("#fajlnevKiir").text(fajlneve)
            console.log(kod)
            return kod;
        })
    }
}

export default FajlNev;