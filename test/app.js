let items = [
    {'name':'Engine Clean', 'url':'1.png','price':'80 DH','rating':'4'},
    {'name':'ALL Purpose CLEANER + Nettoyant', 'url':'2.png','price':'80 DH','rating':'4'},
    {'name':'Hyper Wash', 'url':'3.png','price':'80 DH','rating':'5'},
    {'name':'GC Leather & Vinyl Cleaner', 'url':'4.png','price':'80 DH','rating':'3.5'},
    {'name':'205 ultra fine polish', 'url':'5.png','price':'80 DH','rating':'2'},
    {'name':'3 en 1 WAX', 'url':'6.png','price':'80 DH','rating':'0'},
    {'name':'Rupes Bigfoot LHR21', 'url':'7.png','price':'80 DH','rating':'5'},
    {'name':'all Metal Polish NXT', 'url':'8.png','price':'80 DH','rating':'1'},
    {'name':'Body Duster - EU Label', 'url':'9.png','price':'80 DH','rating':'1.5'},
    {'name':'Noone Safety Triangles DOT Approved', 'url':'10.png','price':'80 DH','rating':'0.5'},
    {'name':'Track Tire Straps', 'url':'11.png','price':'80 DH','rating':'4.5'},
    {'name':'Outil BUZZETTI réglage du jeu de soupape avec adaptateur 8,9,10mm', 'url':'12.png','price':'80 DH','rating':'3'},
    ];

    let afficher = () => {

        for (let f of items) {
            document.getElementById('pic').innerHTML += `<div class="card col-md-3 col-sm-12 text-center">
            <div class="card-header">
            <img src="images/` + f.url + `" class="card-img-top" alt="...">
          </div>
        <div class="card-body">
            <h5 class="card-title border border-danger">`+ f.name +`</h5> 
        </div>
        </div> `;
        }
    }
    let rechercher = () => {
        document.getElementById('pic').innerHTML = "";
       
        let motCle = document.getElementById('rech').value;

        if (motCle =="") {
            itemsRech = items;
        }
        else {
            itemsRech = items.filter( f => f.name.toLowerCase().includes(motCle.toLowerCase()) );
        }

       
        itemsRech = items.filter( f => f.name.toLowerCase().includes(motCle.toLowerCase()) );
        for (let f of itemsRech) {
            document.getElementById('pic').innerHTML += `<div class="card col-md-3 col-sm-12" style="text-align: center;">
        <img class ="image" src="Images/` + f.url + `" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">`+ f.name +`</h5> 
            <p class="card-text text-danger">`+f.price+`</p>
            <p `;
            let x = parseInt(f.rating);
        for (let i=0;i<5;i++){
            if (x==0.5){
                document.getElementById('pic').innerHTML +=`<i class="fa fa-star-half-o" style="color: #fff700;"></i>></i>`;
            }
            else if (x>=1){
                document.getElementById('pic').innerHTML +=`<i class="fa-solid fa-star" style="color: #fff700;"></i> ></i>`;
            }
            else{
                document.getElementById('pic').innerHTML +=`<i class="fa-light fa-star" style="color: #fff700;"></i>></i>`;
            }
        }
        document.getElementById('pic').innerHTML += `</p>
        </div>
        </div> `;
        }

    }