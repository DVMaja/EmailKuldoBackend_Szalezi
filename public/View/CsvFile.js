class CsvFile {
    constructor(szuloElem) {
        console.log("CsvFile");
        this.divElem = szuloElem;
        this.#megjelenit();
    }

    #megjelenit() {
        let txt = ` 
        Itt kell majd kiválasztani melyik csv fájl kerüljön be az adatbázisba:        
        <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" id="csvFile" name="file" accept=".csv">   
                        
            <button type="submit" id="csvFel">CSV feltöltése</button>
        </form>`;
        this.divElem.append(txt);

        $("#uploadForm").on("submit", (event) => {
            event.preventDefault();
            this.uploadCsvFile();
        });
    }

    uploadCsvFile() {
        const fileInput = document.getElementById("csvFile");
        console.log("Fájl bemenet:", fileInput);
        const file = fileInput.files[0];
        console.log("Kiválasztott fájl:", file);
        if (!file) {
            console.error("Nincs fájl kiválasztva.");
            return;
        }

        const reader = new FileReader();

        reader.onload = () => {
            const csvData = reader.result;
            const event = new CustomEvent("csvUploaded", { detail: csvData });
            window.dispatchEvent(event);
        };

        reader.readAsText(file);

        this.#esemenyTrigger(); // Trigger the "csvFel" event
    }


    #esemenyTrigger(esemenyneve) {
        const esemeny = new CustomEvent("csvFel", { detail: this });
        window.dispatchEvent(esemeny);
    }

}

export default CsvFile;
