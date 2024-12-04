function validarCBU( cbu ){
    if(cbu.length != 22){
        return false;
    }
    cod = cbu.substring(0, 3);
    if(cbu == '0000000000000000000000'){
        return false;
    }
    if(cbu == '5555555555555555555555'){
        return false;
    }
    if(validarBloque1(cbu)){
        if(validarBloque2(cbu)){
            if(bancos.includes(cod)){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function validarBloque1(cbu){
    val = parseInt(cbu.substring(7, 8));
    suma = (parseInt(cbu.substring(0, 1))*7)
            +(parseInt(cbu.substring(1, 2))*1)
            +(parseInt(cbu.substring(2, 3))*3)
            +(parseInt(cbu.substring(3, 4))*9)
            +(parseInt(cbu.substring(4, 5))*7)
            +(parseInt(cbu.substring(5, 6))*1)
            +(parseInt(cbu.substring(6, 7))*3)
    suma = suma.toString();
    ultimo = suma.length-1;
    dif = 10 - parseInt(suma.substring(ultimo));
    if(val != 0){
        if(val == dif){
            return true;
        }else{
            return false;
        }
    }else{
        if(dif == 10){
            return true;
        }else{
            return false;
        }
    }
}
function validarBloque2(cbu){
    val = parseInt(cbu.substring(21, 22));
    suma = (parseInt(cbu.substring(8, 9))*3)
            +(parseInt(cbu.substring(9, 10))*9)
            +(parseInt(cbu.substring(10, 11))*7)
            +(parseInt(cbu.substring(11, 12))*1)
            +(parseInt(cbu.substring(12, 13))*3)
            +(parseInt(cbu.substring(13, 14))*9)
            +(parseInt(cbu.substring(14, 15))*7)
            +(parseInt(cbu.substring(15, 16))*1)
            +(parseInt(cbu.substring(16, 17))*3)
            +(parseInt(cbu.substring(17, 18))*9)
            +(parseInt(cbu.substring(18, 19))*7)
            +(parseInt(cbu.substring(19, 20))*1)
            +(parseInt(cbu.substring(20, 21))*3)
    suma = suma.toString();
    ultimo = suma.length-1;
    dif = 10 - parseInt(suma.substring(ultimo));
    if(val != 0){
        if(val == dif){
            return true;
        }else{
            return false;
        }
    }else{
        if(dif == 10){
            return true;
        }else{
            return false;
        }
    }
}