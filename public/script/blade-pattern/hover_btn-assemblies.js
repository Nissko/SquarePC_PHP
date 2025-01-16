//configuration btn
for(let i = 0; i < 99; i++) {
    $('.configurate_assemblies-'+i).hover(function(e) {
        $('.configurate_assemblies-'+i).text(e.type === "mouseenter"?"Конфигурировать":"Конфигурировать");
        $('.configurate_assemblies-'+i).css("background-color",e.type === "mouseenter"?"coral":"white");
        $('.configurate_assemblies-'+i).css("color",e.type === "mouseenter"?"white":"coral");
    });
}

//buy btn
for(let i = 0; i < 99; i++) {
    $('.buy_assemblies-'+i).hover(function(e) {
        $('.buy_assemblies-'+i).css("background-color",e.type === "mouseenter"?"forestgreen":"white");
        $('.buy_assemblies-'+i).css("color",e.type === "mouseenter"?"white":"forestgreen");
    });
}
