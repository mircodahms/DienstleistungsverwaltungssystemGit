<?php

// LogIn-Seite
Route::set('index.php', function() {
    HeadHTML::CreateView('HeadHTML');
    Index::CreateView('Index');
});

// Dashboard mit Dienstleistungseinsicht
Route::set('dashboard', function() {
    Dashboard::isLogin();
    HeadHTML::CreateView('HeadHTML');
    Dashboard::CreateView('Dashboard');
    Dashboard::getDienste();
    Dashboard::CreateView('FooterDashboard');
});

//Dienst bearbeiten
Route::set('dienstbearbeiten', function() {
    EditDienst::isLogin();
    HeadHTML::CreateView('HeadHTML');
    EditDienst::CreateView('EditDienst');
    EditDienst::postAttribute();
    Footer::CreateView('Footer');
});


//Dienst bearbeitet
Route::set('dienstbearbeitet', function() {
    DataUpdate::isLogin();
    HeadHTML::CreateView('HeadHTML');
    DataUpdate::editAttribut();
    Footer::CreateView('Footer');
});

//Nutzer bearbeiten
Route::set('nutzerverwalten', function() {
    EditNutzerdaten::isLogin();
    HeadHTML::CreateView('HeadHTML');
    EditNutzerdaten::CreateView('EditNutzerdaten');
    EditNutzerdaten::editDatas();
    Footer::CreateView('Footer');
});

Route::set('dienste', function() {
    Dashboard::isLogin();
    HeadHTML::CreateView('HeadHTML');
    Dienste::CreateView('Dienste');
});

Route::set('dienstmanagement', function() {
    Dashboard::isLogin();
    HeadHTML::CreateView('HeadHTML');
    Dienstmanagement::CreateView('Dienstmanagement');
    Dienstmanagement::getDienstname();
    Dienstmanagement::postDatas();
});

Route::set('Angelegt', function() {
    Angelegt::CreateView('Angelegt');
});
?>