//------------------token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//liste filiere

$('#remove-scroll #caisse #new-etudiant').on('click', function(e) {
    $('#paiement-nouveau #formulaire #liste-filier option').remove();
    var url = '/liste/filiere';
    var option;
    $.get(url, function(data) {
            option = $('<option/>', {
                text: '',
            });
            $('#paiement-nouveau #formulaire #liste-filier').append(option);
            for (var index = 0; index < data.length; index++) {
                option = $('<option/>', {
                    text: data[index].nom + '=>' + data[index].code,
                    val: data[index].id,
                });
                $('#paiement-nouveau #formulaire #liste-filier').append(option);
            }


        })
        //liste-filier
})


//charger les classes disponibles


$('#formulaire #liste-filier').change(function(e) {
    $('#nbre_etudiant_classe').val('');
    $('#formulaire #liste-classe option').remove();
    var id = $('#formulaire #liste-filier').val();
    var url = '/Chercheur/filiere/classe';
    var option;
    $.post(url, { id: id }, function(data) {

        if (data.length == 0) {
            option = $('<option/>', {
                text: 'Aucune classe existante pour cette filière.'
            });
            $('#formulaire #liste-classe').append(option);
            $('#nbre_etudiant_classe').val('');

        } else {
            option = $('<option/>', {
                text: '------'
            });
            $('#formulaire #liste-classe').append(option);

            for (var index = 0; index < data.length; index++) {
                option = $('<option/>', {
                    text: data[index].code + ' ' + data[index].code_classe,
                    val: data[index].code + ' ' + data[index].code_classe
                });
                $('#formulaire #liste-classe').append(option);
            }
        }

    })
})



//nombre etudiant par classe

$(document).on('change', '#liste-classe', function(e) {
    var classe = $(this).val();
    $.post('/Liste_etudiants', { classe: classe }, function(data) {
        if (classe == '------') {
            $('#nbre_etudiant_classe').val('');
        } else {
            $('#nbre_etudiant_classe').val(data.length + ' élève(s).');

        }
    });
})

//-----------------ajouter filiere

$('#filiere').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var post = $(this).attr('method');
    $.ajax({
        type: post,
        url: url,
        data: data,
        dataTy: 'json',
        success: function(data) {
            if (data == 'Cette filière ou ce code de filière existe déjà') {
                alert(data);
            } else {

                var tr = $('<tr/>', {
                    id: data.id
                });
                tr.append($('<td/>', {
                    text: data.id
                })).append($('<td/>', {
                    text: data.nom
                })).append($('<td/>', {
                    text: data.code
                })).append($('<td/>', {
                    text: data.niveau
                })).append($('<td/>', {
                    html: '<a href="#"  id="mod" data-id="' + data.id + '" data-toggle="modal" data-target="#modifier-filiere"><code class="badge badge-error" >Modifier</code></a>  ' +
                        '<a href="#"  id="supp" data-id="' + data.id + '"><code class="badge badge-danger" >Supprimer</code></a>  ' +
                        '<a href="#"  id="voir" data-id="' + data.id + '"><code class="badge badge-info" data-toggle="modal" data-target="#voir-filiere">voir</code></a>  '
                }))

                $('#filiere').hide('500');
                $('#tableFiliere #nouveau').append(tr);
                $('#nbreFiliere').val(parseInt($('#nbreFiliere').val()) + 1);
                $('#filiere').show('200');
            }
        }
    })

})


//suppression de filiere;

$(document).on('click', '#supp', function(e) {
    var id = $(this).data('id');
    var s = confirm('vouler vous vraiment supprimer cette filière??');
    var route = "/Supprimer/Filiere";
    if (s) {
        $.post(route, { id: id }, function(data) {
            alert(data);
            if (data == 'Impossible de supprimer cette filière elle contient des Classes. bien vouloir les supprimer') {

            } else {
                $('#tableFiliere #' + id).remove();
                $('#nbreFiliere').val($('#nbreFiliere').val() - 1);
            }

        })
    }
})


//chargement avant Modification

$(document).on('click', '#mod', function(e) {
    var id = $(this).data('id');
    $.post('/Chercheur/filiere', { id: id }, function(data) {
        $('#modifier-filiere #nom').val(data.nom);
        $('#modifier-filiere #code').val(data.code);
        $('#modifier-filiere #niveau').val(data.niveau);
        $('#modifier-filiere #ident').val(data.id);
    })
})

//mise a jour de filiere

$('#form-mod-fil').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');

    $.post(url, data, function(data) {
        $('#form-mod-fil').trigger('reset');

        var tr = $('<tr/>', {
            id: data.id
        });
        tr.append($('<td/>', {
            text: data.id
        })).append($('<td/>', {
            text: data.nom
        })).append($('<td/>', {
            text: data.code
        })).append($('<td/>', {
            text: data.niveau
        })).append($('<td/>', {
            html: '<a href="#"  id="mod" data-id="' + data.id + '" data-toggle="modal" data-target="#modifier-filiere"><code class="badge badge-error" >Modifier</code></a>  ' +
                '<a href="#"  id="supp" data-id="' + data.id + '"><code class="badge badge-danger" >Supprimer</code></a>  ' +
                '<a href="#"  id="voir" data-id="' + data.id + '"><code class="badge badge-info" data-toggle="modal" data-target="#voir-filiere">voir</code></a>  '
        }))
        $('#tableFiliere tr#' + data.id).replaceWith(tr);
        alert(data);
    });
})

//voir filiere

$(document).on('click', '#voir', function(e) {
    var url = '/voir/Filiere';
    var id = $(this).data('id');
    var element = '';
    $.post(url, { id: id }, function(data) {
        if (data.length == 0) {
            $('#voir-fil #num').val('Aucune classe');
            $('#voir-fil #nom').val('Aucune classe');
            $('#voir-fil #code').val('Aucune classe');
            $('#voir-fil #nbre').val('Aucune classe');
            $('#voir-fil #clas').val('Aucune classe');
        } else {
            for (var index = 0; index < data.length; index++) {
                element = element + data[index].code + ' ' + data[index].code_classe + ' ; ';
            }
            $('#voir-fil #num').val('NUMERO  :  ' + data[0].id);
            $('#voir-fil #nom').val('LIBELLE  :  ' + data[0].nom);
            $('#voir-fil #code').val('CODE  :  ' + data[0].code);
            $('#voir-fil #nbre').val('Nombre de classe :  ' + data.length);
            $('#voir-fil #clas').val('Liste de classe :  ' + element);
        }

    })
})




//Classe

//charger les nombre de filieres

$('#classe #classe-filiere').change(function(e) {
    $('#classe #class-niveau option').remove();
    var id = $('#classe #classe-filiere').val();
    var url = '/Chercheur/filiere';
    var option;
    $.post(url, { id: id }, function(data) {

        for (var index = 1; index <= data.niveau; index++) {
            option = $('<option/>', {
                text: index,
                val: index
            });
            $('#classe #class-niveau').append(option);
        }
    })
})

//Ajouter une classe

$('#classe').on('submit', function(e) {
    e.preventDefault();
    var post = $(this).attr('method');
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.ajax({
        data: data,
        type: post,
        url: url,
        dataTy: 'json',
        success: function(data) {

            if (data == 'Cette classe existe déjà') {
                alert(data);
            } else {
                var tr = $('<tr/>', {
                    id: data.id
                });
                tr.append($('<td/>', {
                    text: data.id
                })).append($('<td/>', {
                    text: data.nom
                })).append($('<td/>', {
                    text: data.niveau
                })).append($('<td/>', {
                    text: data.code_f + ' ' + data.code_classe
                })).append($('<td/>', {
                    html: '<a href="#"  id="mod-classe" data-id="' + data.id + '" data-toggle="modal" data-target="#modifier-classe"><code class="badge badge-error" >Fusionner</code></a>  ' +
                        '<a href="#"  id="supp-classe" data-id="' + data.id + '"><code class="badge badge-danger" >Supprimer</code></a>  ' +
                        '<a href="#"  id="voir-classe" data-id="' + data.id + '"><code class="badge badge-info" >voir</code></a>  '
                }))
                $('#nouveau').append(tr);
                $('#nbreclasse').val((parseInt($('#nbreclasse').val()) + 1));
                $('#classe').hide('500');
                $('#classe').show('100');

            }

        }
    })
})

//suppression de classe
$(document).on('click', '#supp-classe', function(e) {
    var id = $(this).data('id');
    var url = '/Supprimer/classe';
    var supp = confirm('voulez vous vraiment supprimer cette classe?')
    if (supp) {
        $.post(url, { id: id }, function(data) {
            alert(data);
            if (data == 'Impossible de supprimer cette classe elle contient des étudiants. bien vouloir les transférer avant la suppression') {

            } else {
                $('#nbreclasse').val((parseInt($('#nbreclasse').val()) - 1));
                $('#tableclasse #' + id).remove();
            }

        })
    }
})

//Entame de modification des classes

//chercheur

$(document).on('click', '#mod-classe', function(e) {
    var id = $(this).data('id');
    var url = '/Chercheur/classe';
    $.post(url, { id: id }, function(data) {
        $('#form-mod-classe #lib').val(data.filiere);
        $('#form-mod-classe #code').val(data.code);
        $('#form-mod-classe #nb').val(data.nbrePlace);
        $('#form-mod-classe #desc').val(data.description);
        $('#form-mod-classe #ident').val(data.id);

    })
})

//mis a jour

$('#form-mod-classe').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, data, function(data) {
        $('#form-mod-classe').trigger('reset');

        var tr = $('<tr/>', {
            id: data.id
        });
        tr.append($('<td/>', {
            text: data.id_classe
        })).append($('<td/>', {
            text: data.filiere
        })).append($('<td/>', {
            text: data.code
        })).append($('<td/>', {
            text: data.nbPlace
        })).append($('<td/>', {
            text: data.description
        })).append($('<td/>', {
            text: data.filiere + data.code
        })).append($('<td/>', {
            html: '<a href="#"  id="mod-classe" data-id="' + data.id_classe + '" data-toggle="modal" data-target="#modifier-classe"><code class="badge badge-error" >Modifier</code></a>  ' +
                '<a href="#"  id="supp-classe" data-id="' + data.id_classe + '"><code class="badge badge-danger" >Supprimer</code></a>  ' +
                '<a href="#"  id="voir-classe" data-id="' + data.id_classe + '"><code class="badge badge-info" >voir</code></a>  '
        }))
        console.log(data);

        $('#tableclasse tr#' + data.id_classe).replaceWith(tr);


    })

});


//solvabilité

$('#tableSolvabilite #voir-solv').on('click', function(e) {
    classe = $(this).data('id');
    url = '/Listesolvabilité';
    var total;

    $.post('/totalApayer', { classe: classe }, function(data) {
        total = data;
    });



    $.post(url, { classe: classe }, function(data) {
        $('#res #insert-sol #1').remove();
        var block = $('<tbody/>', {
            id: 1,
        });
        for (var index = 0; index < data.length; index++) {
            var tr = $('<tr/>');
            if ((total - data[index].montant) == 0) {
                var statut = 'OK'
            } else {
                var statut = 'NON OK'
            }
            tr.append($('<td/>', {
                text: data[index].matricule,
            })).append($('<td/>', {
                text: data[index].nom,
            })).append($('<td/>', {
                text: data[index].prenom,
            })).append($('<td/>', {
                text: data[index].classe,
            })).append($('<td/>', {
                text: data[index].montant + ' fcfa',
            })).append($('<td/>', {
                text: total - data[index].montant + ' fcfa',
            })).append($('<td/>', {
                text: statut,
            }));
            block.append(tr);
        }
        block.append($('<td/>', {
            html: '<a href="/solvabilité" id="lien"><input type="button" class="btn btn-success" button value="OK"></a>'

        }));
        $('#tableSolvabilite #statutclasse').remove();
        $('#tableSolvabilite').remove();
        $('#res #insert-sol ').append(block)
    })

});



//-----enregistrer les taux

$('#remove-scroll #caisse #new-taux').on('click', function(e) {
    $('#fixer-les-taux #formulaire-taux #liste-filier option').remove();
    var url = '/liste/filiere';
    var option;
    $.get(url, function(data) {
        option = $('<option/>', {
            text: '',
        });
        $('#fixer-les-taux #formulaire-taux #liste-filier').append(option);
        for (var index = 0; index < data.length; index++) {
            option = $('<option/>', {
                text: data[index].nom + '=>' + data[index].code,
                val: data[index].id,
            });
            $('#fixer-les-taux #formulaire-taux #liste-filier').append(option);
        }


    })
})



//charger les filieres

$('#formulaire-taux #liste-filier').change(function(e) {
    $('#formulaire-taux #liste-niveau option').remove();
    var id = $('#formulaire-taux #liste-filier').val();
    var url = '/Chercheur/filiere';
    var option;
    $.post(url, { id: id }, function(data) {
        option = $('<option/>', {
            text: ''
        });
        $('#formulaire-taux #liste-niveau').append(option);
        for (var index = 1; index <= data.niveau; index++) {
            option = $('<option/>', {
                text: index,
                val: index
            });
            $('#formulaire-taux #liste-niveau').append(option);
        }
    })
})

//charger les tranches
$('#fixer-les-taux #formulaire-taux #liste-tranche').change(function() {
    $('#fixer-les-taux #formulaire-taux #1').remove();
    var nbre = $(this).val();
    var ladate = new Date();
    ladate = ladate.getFullYear() + "-" + (ladate.getMonth() + 1) + "-" + (ladate.getDate() + 1);
    var div = $('<div/>', {
        id: 1,
    })
    div.append(
        '<div class="form-group"><div class="col-md-12"><strong>INSCRIPTION </strong></div> <input type="number" name="montant" min="500" class="form-control" required /></div>' +
        '<div class="form-group"><div class="col-md-12"><strong>Date Limite:</strong></div> <input type="date" date-format="YYYY-MM-DD" required name="date" min="' + ladate + '" class="form-control"/></div>'
    );

    $('#fixer-les-taux #formulaire-taux').append(div);

    for (var index = 1; index < nbre; index++) {
        div.append(
            '<div class="form-group"><div class="col-md-12"><strong>TRANCHE:' + (index) + '</strong></div> <input type="number" name="montant' + (index + 1) + '" min="500" class="form-control" required /></div>' +
            '<div class="form-group"><div class="col-md-12"><strong>Date Limite:</strong></div> <input type="date" date-format="YYYY-MM-DD" required name="date' + (index + 1) + '" min="' + ladate + '" class="form-control"/></div>'
        )
        $('#fixer-les-taux #formulaire-taux').append(div);
    }

});

$('#fixer-les-taux #formulaire-taux').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');

    var con = confirm('les taux entrées et les dates sont sont ils conforme? car aucune modification ne pourra se faire avant l"année accademique suivante');
    if (con) {
        $.post(url, data, function(data) {
            alert(data);

            $('#formulaire-taux').hide('500');
            $('#formulaire-taux').show('100');
        })
    }

});

// voir les taux


$('#remove-scroll #caisse #new-taux').on('click', function(e) {
    $('#voir-les-taux #formulaire-mtaux #liste-filier option').remove();
    var url = '/liste/filiere';
    var option;
    $.get(url, function(data) {
        option = $('<option/>', {
            text: '',
        });
        $('#voir-les-taux #formulaire-mtaux #liste-filier').append(option);
        for (var index = 0; index < data.length; index++) {
            option = $('<option/>', {
                text: data[index].nom + '=>' + data[index].code,
                val: data[index].id,
            });
            $('#voir-les-taux #formulaire-mtaux #liste-filier').append(option);
        }


    })
})



//charger les filieres

$('#formulaire-mtaux #liste-filier').change(function(e) {
    $('#formulaire-mtaux #liste-niveau option').remove();
    var id = $('#formulaire-mtaux #liste-filier').val();
    var url = '/Chercheur/filiere';
    var option;
    $.post(url, { id: id }, function(data) {
        option = $('<option/>', {
            text: ''
        });
        $('#formulaire-mtaux #liste-niveau').append(option);
        for (var index = 1; index <= data.niveau; index++) {
            option = $('<option/>', {
                text: index,
                val: index
            });
            $('#formulaire-mtaux #liste-niveau').append(option);
        }
    })
})



//etudiant

$('#tableetudiants #voir-etu').on('click', function(e) {
    var url = '/Liste_etudiants';
    var classe = $(this).data('id');
    var id_classe = $(this).data('id_classe');

    $(this).replaceWith('Veuillez patienter...');

    $.post(url, { classe: classe }, function(data) {


        if (data.length <= 0) {
            alert('Aucun étudiant dans cette salle de classe');
        } else {

            $.get('/recharcher titulaires', { id: id_classe }, function(p) {

                $('#title #b').remove();
                $('#title ').append($('<b/>', {
                    text: 'titulaire : ' + p[0].nom + ' ' + p[0].prenom,
                }))
            });

            $('#title #b').remove();
            $('#title ').append($('<b/>', {
                text: 'liste des étudiants de la ' + data[0].classe + '____________________' + data.length + 'élève(s) _______________',
            }))


            $('#tableetudiants #entete').remove();
            $('#tableetudiants #corps').remove();
            var table = $('<thead > <th>Numèro</th>  <th>Matricule</th> <th>Nom</th><th>Prenom</th> <th>classe</th><th>sexe</th><th>date de naissance</th>' +
                '<th class="ne_pas_imprimer">Manipulations</th> </tr></thead>');
            table.append($('<tbody>'))
            for (var index = 0; index < data.length; index++) {
                table.append($('<tr/>', {
                    id: index + 1
                })).append($('<td/>', {
                    text: index + 1
                })).append($('<td/>', {
                    text: data[index].matricule
                })).append($('<td/>', {
                    text: data[index].nom
                })).append($('<td/>', {
                    text: data[index].prenom
                })).append($('<td/>', {
                    text: data[index].classe
                })).append($('<td/>', {
                    text: data[index].sexe
                })).append($('<td/>', {
                    text: data[index].naissance
                })).append($('<td/>', {
                    html: '<a href="#"  id="mod-etud" data-id="' + data[index].matricule + '" data-toggle="modal" data-target="#modifier-etudiant"><code class="badge badge-error" >Modifier</code></a>  ' +
                        '<a href="#"  id="supp-etud" data-id="' + data[index].matricule + '"><code class="badge badge-danger" >Supprimer</code></a>  ' +
                        '<a href="#"  id="trans-etud" data-id="' + data[index].matricule + '"><code class="badge badge-info" data-toggle="modal" data-target="#transferer-etudiant" >transferer</code></a>  ',

                    class: 'ne_pas_imprimer'
                }));


            }
            table.append($('<tr/>', {
                html: '<td colspan="8"><a href="/Gérer_les_étudiants" id="lien"><input type="button" class="btn btn-success" button value="OK"></a> <input type="button" class="btn btn-success text-right" onclick="window.print()" button value="IMPRIMER">',
                class: 'ne_pas_imprimer'

            }))
            $('#tableetudiants').append(table);
        }

    })
});



//modifier un etudiant

$(document).on('click', '#mod-etud', function(e) {
    var matricule = $(this).data('id');
    var url = '/rechercher_etudiants';
    $.post(url, { matricule: matricule }, function(data) {
        $('#modifier-etudiant #form-mod-etd #nom').val(data.nom);
        $('#modifier-etudiant #form-mod-etd #prenom').val(data.prenom);
        $('#modifier-etudiant #form-mod-etd #sexe').val(data.sexe);
        $('#modifier-etudiant #form-mod-etd #date').val(data.naissance);
        $('#modifier-etudiant #form-mod-etd #matricule').val(matricule);
    })
});


$('#modifier-etudiant #form-mod-etd').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, data, function(data) {
        alert('mise à jour réalisé avec success')
        $('#modifier-etudiant #form-mod-etd').remove();
        window.location.reload();
    })
});

//suppression etudiant

$(document).on('click', '#supp-etud', function(e) {
    var matricule = $(this).data('id');

    $.post('/rechercher_etudiants', { matricule: matricule }, function(data) {
        var conf = confirm('voulez vous vraiment supprimer l\'étudiant "' + data.nom + ' ' + data.prenom + '" de la "' + data.classe + '"');
        if (conf) {
            var url = 'supprimer_etudiants';
            $.post(url, { matricule: matricule }, function(data) {
                alert('etudiant supprimé avec succès');
                window.location.reload();
            })
        }

    })

})

//transfert etudiant

$(document).on('click', '#trans-etud', function(e) {

    var matricule = $(this).data('id');
    var url = '/rechercher_etudiants';
    $.post(url, { matricule: matricule }, function(data) {
        $('#transferer-etudiant #form-trans-etd #classe').val(data.classe);
        $('#transferer-etudiant #form-trans-etd #matricule').val(data.matricule);
    });


    $.get('/toute/classe', function(data) {

        for (var index = 0; index < data.length; index++) {
            $('#transferer-etudiant #form-trans-etd  #classe-transfert #' + index).remove();
        }

        for (var index = 0; index < data.length; index++) {
            var option = ($('<option/>', {
                text: data[index].nom_classe,
                val: data[index].nom_classe,
                id: index,
            }));
            $('#transferer-etudiant #form-trans-etd #classe-transfert').append(option);
        }

    });

});

//demarage du transfert
$('#transferer-etudiant #form-trans-etd').on('submit', function(e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function(data) {
        alert('Transfert étudié avec succés');
        window.location.reload();
    })
});


//matiere

$('#tableMatiere #voir-matiere').on('click', function(e) {
    var classe = $(this).data('id');
    var filiere = $(this).data('filiere');
    var niveau = $(this).data('niv');
    $('#ajouer-matiere #form-ajout-mat #classe_cache').val(classe);
    $('#ajouer-matiere #form-ajout-mat #classe').val(classe);

    var option;
    $('#ajouer-matiere #form-ajout-mat #groupe #3b').remove();
    $.post('/charger groupe', { filiere: filiere, niveau: niveau }, function(data) {
        for (let index = 0; index < data.length; index++) {
            option = $('<option/>', {
                val: data[index].id,
                text: data[index].nom,
                id: '3b',
            });

            $('#ajouer-matiere #form-ajout-mat #groupe').append(option);
        }

    });

});

//
$('#ajouer-matiere #form-ajout-mat').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action')
    $.post(url, data, function(data) {
        alert(data);
        $('#ajouer-matiere').hide('500');
        $('#ajouer-matiere').show('100');
    })
});

//

$('#tableMatiere #Liste-matiere').on('click', function(e) {
    var classe = $(this).data('id');
    var url = '/liste_des_matieres';

    $.post(url, { classe: classe }, function(data) {

        var table = $('<thead> <th>Numèro</th> <th>groupe</th> <th>Nom</th><th>matière</th> <th>classe</th><th>coef</th><th>nombre heures</th>' +
            '<th>Manipulations</th> </tr></thead>');
        for (var index = 0; index < data.length; index++) {
            table.append($('<tr/>', {
                id: data[index].id
            })).append($('<td/>', {
                text: index + 1
            })).append($('<td/>', {
                text: data[index].nom,
            })).append($('<td/>', {
                text: data[index].nomProf,
            })).append($('<td/>', {
                text: data[index].nommatiere,
            })).append($('<td/>', {
                text: data[index].classe,
            })).append($('<td/>', {
                text: data[index].coef,
            })).append($('<td/>', {
                text: data[index].nombre_heure,
            })).append($('<td/>', {
                html: '<a href="#"  id="mod-mat" data-id="' + data[index].id + '" data-filiere="' + data[index].filiere + '" data-niv="' + data[index].niveau + '" data-toggle="modal" data-target="#modifier-matiere"><code class="badge badge-error" >Modifier</code></a>  ' +
                    '<a href="#"  id="supp-mat" data-id="' + data[index].id + '"><code class="badge badge-danger" >Supprimer</code></a>  ',

            }));

        }

        table.append($('<tr/>', {
            html: '<a href=""><button class="btn btn-success" >ok</button></a>  ',
        }))
        $('#tableMatiere').remove();
        $('#into').append(table);
    })
});


//modifier matiere

$(document).on('click', '#mod-mat', function(e) {
    var id = $(this).data('id');
    var url = '/rechercher_matieres';
    $.post(url, { id: id }, function(data) {
        $('#form-mod-mat #anc-classe').val(data.classe);
        $('#form-mod-mat #matiere').val(data.nom);
        $('#form-mod-mat #anc-prof').val(data.nom_prof + ' ' + data.prenom);
        $('#form-mod-mat #anc-coef').val(data.coef);
        $('#form-mod-mat #coef').val(data.coef);
        $('#form-mod-mat #anc-heure').val(data.nombre_heure);
        $('#form-mod-mat #nbheure').val(data.nombre_heure);
        $('#form-mod-mat #id').val(id);
        $('#form-mod-mat #filiere_niveau').val(data.filiere_niveau);
        $('#form-mod-mat #id_professeur').val(data.id);
        $('#form-mod-mat #anc-groupe').val(data.nom_g);
    })

    var filiere = $(this).data('filiere');
    var niveau = $(this).data('niv');

    var option;
    $('#modifier-matiere #form-mod-mat #groupe #3b').remove();
    $.post('/charger groupe', { filiere: filiere, niveau: niveau }, function(data) {
        for (let index = 0; index < data.length; index++) {
            option = $('<option/>', {
                val: data[index].id,
                text: data[index].nom,
                id: '3b',
            });

            $('#modifier-matiere #form-mod-mat #groupe').append(option);
        }

    });

})


$('#form-mod-mat').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, data, function(data) {
        alert(data);
        window.location.reload();
    })
})

$(document).on('click', '#supp-mat', function(e) {
    var id = $(this).data('id');
    var url = '/supprimer_matieres';

    var conf = confirm('cette suppression entrainera la suppression de cette matières dans les autres classes du même niveau de la même filiière ainsi que tout ce qui la concerne!!!')
    if (conf) {
        $.post(url, { id: id }, function(data) {
            alert(data)
            window.location.reload();

        });
    }

})

//
//edt


$('#tableEDT #sup-edt').on('click', function(e) {
    var classe = $(this).data('classe');
    var url = '/sup_EmploiDeTemps';

    var conf = confirm('voulez vous vraiment supprimer l\'emploid de temps de la "' + classe + '"');

    if (conf) {
        $.post(url, { classe: classe }, function(data) {
            alert(data);
        })
    }

});



//discipline

$('#tablediscipline #voir-disc').on('click', function(e) {

    var url = '/Liste_etudiants';
    var classe = $(this).data('id');


    $.post(url, { classe: classe }, function(data) {


        if (data.length <= 0) {
            alert('Aucun étudiant dans cette salle de classe');
        } else {


            $('#title #b').remove();
            $('#title ').append($('<b/>', {
                text: 'liste des étudiants de la ' + data[0].classe,
            }))


            $('#tablediscipline #tbody').remove();
            $('#tablediscipline #corps').remove();
            $('#tablediscipline #89').remove();
            var table = $('<thead id="89"> <th>Numèro</th>  <th>Matricule</th> <th>Nom</th><th>Prenom</th> <th>classe</th><th>sexe</th><th>date de naissance</th>' +
                '<th>Manipulations</th> </tr></thead>');
            table.append($('<tbody>'))
            for (var index = 0; index < data.length; index++) {
                table.append($('<tr/>', {
                    id: index + 1
                })).append($('<td/>', {
                    text: index + 1
                })).append($('<td/>', {
                    text: data[index].matricule
                })).append($('<td/>', {
                    text: data[index].nom
                })).append($('<td/>', {
                    text: data[index].prenom
                })).append($('<td/>', {
                    text: data[index].classe
                })).append($('<td/>', {
                    text: data[index].sexe
                })).append($('<td/>', {
                    text: data[index].naissance
                })).append($('<td/>', {
                    html: '<a href="#"  id="add-discipline" data-id="' + data[index].matricule + '" data-toggle="modal" data-target="#discipline-etudiant"><code class="badge badge-danger" >Ajouter CD</code></a>  ' +
                        '<a href="#"  id="add-casier" data-id="' + data[index].matricule + '"><code class="badge badge-info" data-toggle="modal" data-target="#casier-judiciare" >Casier judiciaire</code></a>  ',

                }));


            }
            table.append($('<tr/>', {
                html: '<a href="" id=""><input type="button" class="btn btn-success" button value="OK"></a>'
            }))
            $('#tablediscipline').append(table);
        }

    })
});

$(document).on('click', '#add-discipline', function(e) {
    var matricule = $(this).data('id');
    var url = '/rechercher_etudiants';
    $.post(url, { matricule: matricule }, function(data) {
        $('#discipline-etudiant #form-add-disc #classe').val(data.classe);
        $('#discipline-etudiant #form-add-disc #matricule').val(data.matricule);
        $('#discipline-etudiant #form-add-disc #nom').val(data.nom);
        $('#discipline-etudiant #form-add-disc #prenom').val(data.prenom);
        $('#discipline-etudiant #form-add-disc #matri').val(data.id);
    });
});


$('#discipline-etudiant #form-add-disc').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = '/ajouter_discipline';
    $.post(url, data, function(data) {
        alert(data);
    });
});

//chargement
$('#tablecd #juge-cd').on('click', function(e) {
    $('#form-juge-cd #nom').val($(this).data('nom'));
    $('#form-juge-cd #matricule').val($(this).data('matricule'));
    $('#form-juge-cd #motif').val($(this).data('motif'));
    $('#form-juge-cd #id').val($(this).data('id'));

    $('#form-juge-cd #decision').change(function(e) {
        $('#form-juge-cd #sanctionneur').remove();
        var val = $(this).val();
        if (val == 'true') {
            $('#form-juge-cd #interieur').append(
                '<div class="col-md-12" id="sanctionneur">' +
                '<div class="form-group">' +
                '<label for="">Sanction</label>' +
                ' <input type="text" name="sanction" class="form-control" required>' +
                '</div>' +

                '</div>'
            );
        }
    })
});


//jugement
$('#form-juge-cd').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var id = data.id;
    var url = $(this).attr('action');
    $.post(url, data, function(data) {
        $('#form-juge-cd').trigger('reset');
        alert(data);
        window.location.reload();

    })
})


$(document).on('click', '#add-casier', function(e) {
    var url = '/caisier_judiaciaire';
    var matricule = $(this).data('id');
    var compteur = 0;

    $.post(url, { matricule: matricule }, function(data) {
        $('#casier-judiciare #form-add-casier #nom').val(data[0].nom);
        $('#casier-judiciare #form-add-casier #prenom').val(data[0].prenom);
        $('#casier-judiciare #form-add-casier #classe').val(data[0].classe);
        $('#casier-judiciare #form-add-casier #matricule').val(data[0].matricule);
        $('#casier-judiciare #form-add-casier #nombreconseil').val(data.length);
        for (var index = 0; index < data.length; index++) {
            if (data[index].coupable == true)
                compteur = compteur + 1;
        }
        $('#casier-judiciare #form-add-casier #nombrejugement').val(compteur);
        url = '/liste_d_absence';
        $.post(url, { matricule: matricule }, function(data) {
            $('#casier-judiciare #form-add-casier #absence').val(data);
        });
    });
});


//gesstion des comptes

$('#tablecomptes #voir-disc').on('click', function(e) {

    var url = '/Liste_etudiants';
    var classe = $(this).data('id');


    $.post(url, { classe: classe }, function(data) {


        if (data.length <= 0) {
            alert('Aucun étudiant dans cette salle de classe');
        } else {


            $('#title #b').remove();
            $('#title ').append($('<b/>', {
                text: 'liste des étudiants de la ' + data[0].classe,
            }))


            $('#tablecomptes #tbody').remove();
            $('#tablecomptes #corps').remove();
            $('#tablecomptes #89').remove();
            var table = $('<thead id="89"> <th>Numèro</th>  <th>Matricule</th> <th>Nom</th><th>Prenom</th> <th>classe</th><th>sexe</th><th>date de naissance</th>' +
                '<th>Manipulations</th> </tr></thead>');
            table.append($('<tbody>'))
            for (var index = 0; index < data.length; index++) {
                table.append($('<tr/>', {
                    id: index + 1
                })).append($('<td/>', {
                    text: index + 1
                })).append($('<td/>', {
                    text: data[index].matricule
                })).append($('<td/>', {
                    text: data[index].nom
                })).append($('<td/>', {
                    text: data[index].prenom
                })).append($('<td/>', {
                    text: data[index].classe
                })).append($('<td/>', {
                    text: data[index].sexe
                })).append($('<td/>', {
                    text: data[index].naissance
                })).append($('<td/>', {
                    html: '<a href="#"  id="supp-compte" data-id="' + data[index].matricule + '"><code class="badge badge-danger" >Supprimer</code></a>  ',

                }));


            }
            table.append($('<tr/>', {
                html: '<a href="" id=""><input type="button" class="btn btn-success" button value="OK"></a>'
            }))
            $('#tablecomptes').append(table);
        }

    })
});

//comptes enseignant

$('#tablecomptes #supp-comptes').on('click', function(e) {
    var matricule = $(this).data('id');

    $.post('/rechercher_etudiants', { matricule: matricule }, function(data) {
        var conf = confirm('voulez vous vraiment supprimer le compte de "' + data.nom + ' ' + data.prenom);
        if (conf) {
            var url = 'supprimer_etudiants';
            $.post(url, { matricule: matricule }, function(data) {
                alert('compte supprimé avec succès');
                window.location.reload();
            })
        }
    });
});


$('#tablecomptes #don-ret-droit').on('click', function(e) {
    var val = $(this).data('val');
    var matricule = $(this).data('id');

    $.post('/rechercher_etudiants', { matricule: matricule }, function(data) {
        if (val == 'donner') {
            var confi = confirm('voulez vous vraiment donner les droits à : ' + data.nom + ' ' + data.prenom);
            if (confi) {
                $.post('/droit_des_comptes', { matricule: matricule, type: val }, function(data) {
                    alert('droit donné avec succès');
                    window.location.reload();

                })
            }
        } else {
            var confi = confirm('voulez vous vraiment retirer les droits à : ' + data.nom + ' ' + data.prenom);
            if (confi) {
                $.post('/droit_des_comptes', { matricule: matricule, type: val }, function(data) {
                    alert('droit retiré avec succès');
                    window.location.reload();
                })
            }
        }
    });
});


//vote

$('#vote #formulaire-vote #retirer #liste').on('change', function(e) {
    $('#vote #formulaire-vote #list').remove();
    var val = $('#vote #formulaire-vote #liste').val();
    for (var index = 0; index < val; index++) {
        $('#vote #formulaire-vote #corps').append(
            '<div class="form-group" id="list"><div class="col-md-12"><strong>matricule:' + (index + 1) + '</strong></div> <input type="text" name="matricule' + (index + 1) + '" class="form-control" required /></div>',
        );
    }

    $('#vote #formulaire-vote #interieur').append(
        '<input type="hidden" name="nbre" value="' + val + '" id="nbre">',
    );
});


//blog

$('#Ajout-sujet #blog').on('submit', function(e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function(data) {
        window.location.reload();
    })
});

$(document).on('click', '#supp-sujet', function(e) {
    var id = $(this).data('id');
    var url = '/supp-sujets';
    var conf = confirm('voulez vous vraiment supprimer ce sujet?')

    if (conf) {
        $.post(url, { id: id }, function(data) {
            alert(data);
            window.location.reload();
        })
    }

})


//message

$('#frame #sidepanel #search #contact').keyup(function(e) {
    $('#frame #sidepanel #result-contact #contenu').remove();
    var content = $(this).val();
    var div = $('<div id="contenu">');
    if (content != "") {
        $.post('/messageEmail', { email: content }, function(data) {
            for (let index = 0; index < data.length; index++) {
                div.append('<img src="/storage/avatars/' + data[index].photo + '" width="40px" style="border-radius:100%" alt="" "_"/> <a href="#" style="color:white" data-id=' + data[index].id + '> <span class="preview">' + data[index].email + '</span></a><br> ');
            }
            $('#frame #sidepanel #result-contact').append(div);
        });
    }

});

// demarrage des evaluations du coté de ladmin**

$('#tableevaluation #lancer').on('click', function(e) {
    var id = $(this).data('id');
    var conf = confirm('voulez-vous vraiment lancer cette evaluation?')
    if (conf == true) {
        $.post('/lancer_eval', { id: id }, function(data) {
            alert(data);
            window.location.reload();
        });

    }
})

// suspension d'une evaluation

$('#tableevaluation #sus').on('click', function(e) {
    var id = $(this).data('id');
    var conf = confirm('voulez-vous vraiment suspendre cette evaluation?')
    if (conf == true) {
        $.post('/suspendre_eval', { id: id }, function(data) {
            alert(data);
            window.location.reload();

        });

    }
})

//suppression d'un evaluation via l'admin

$('#tableevaluation #suppp').on('click', function(e) {
    var id = $(this).data('id');
    var conf = confirm('voulez-vous vraiment supprimer cette evaluation?')
    if (conf == true) {
        $.post('/supp_eval', { id: id }, function(data) {
            $('#tableevaluation #' + id).remove();
            alert(data);
        });

    }
})

//mes evenements

//suppression d'évènements'
$(document).on('click', '#supp-ev', function(e) {
    var id = $(this).data('id');
    var url = '/supp_évènements';
    var supp = confirm('voulez-vous vraiment supprimer cet évènement?')
    if (!supp) {
        e.preventDefault();
    }
})

$(document).on('click', '#voir-ev', function(e) {
    var id = $(this).data('id');

    $('#mod-ev #form-mod-ev #titre').val($(this).data('titre'));
    $('#mod-ev #form-mod-ev #desc').val($(this).data('description'));
    $('#mod-ev #form-mod-ev #date').val($(this).data('date'));
    $('#mod-ev #form-mod-ev #debut').val($(this).data('debut'));
    $('#mod-ev #form-mod-ev #fin').val($(this).data('fin'));
    $('#mod-ev #form-mod-ev #lieu').val($(this).data('lieu'));
    $('#mod-ev #form-mod-ev #id').val(id);


});




//-----enregistrer les tranches

$('#fixer-les-EDT #formulaire-tranche #liste-tranche').change(function() {
    $('#fixer-les-EDT #formulaire-tranche #1').remove();

    var nbre = $(this).val();
    var ladate = new Date();
    ladate = ladate.getFullYear() + "-" + (ladate.getMonth() + 1) + "-" + (ladate.getDate() + 1);
    var div = $('<div/>', {
        id: 1,
    })
    for (var index = 0; index < nbre; index++) {
        div.append(
            '<strong class="btn btn-sm btn-danger">tranche:' + (index + 1) + '</strong>' +
            '<br><strong class="legendLabel" >Début :</strong>' +
            '<input type="time" required  name="hd' + (index + 1) + '" id="hd' + (index + 1) + '" class="form-control1" min="07:00" max="21:00">' +
            '<strong class="legendLabel">Fin :</strong>' +
            '<input type="time" required name="hf' + (index + 1) + '" id="hf' + (index + 1) + '" class="form-control1" min="07:00" max="21:00">' +
            '<strong class="legendLabel">Libellé :</strong>' +
            '<select required  name="libelle' + (index + 1) + '" class="form-control1" >' +
            '<option value="cours"> Cours' +
            '<option value="pause"> Pause' +
            '<select>' +
            '<br>'
        )
        $('#fixer-les-EDT #formulaire-tranche').append(div);
    }


});

$('#fixer-les-EDT #formulaire-tranche').on('submit', function(e) {
    e.preventDefault();
    var nbre = $('#fixer-les-EDT #formulaire-tranche #liste-tranche').val();
    var hd, hf;
    var test = false;
    var url = '/Config edt';
    var data = $(this).serialize();

    for (let index = 0; index < nbre; index++) {
        hd = $('#fixer-les-EDT #formulaire-tranche #1 #hd' + (index + 1)).val();
        hf = $('#fixer-les-EDT #formulaire-tranche #1 #hf' + (index + 1)).val();

        if (hd >= hf) {
            alert('erreur tranche ' + (index + 1) + ' l\'heure de début doit etre strictement suppérieur à l\'heure de fin');
            test = true;
            break;
        }

    }

    if (!test) {
        for (let index = 1; index <= nbre; index++) {
            hd = $('#fixer-les-EDT #formulaire-tranche #1 #hd' + (index)).val();
            hf = $('#fixer-les-EDT #formulaire-tranche #1 #hf' + (index - 1)).val();

            if (hd < hf) {
                alert('erreur l\'heure de debut de la tranche' + (index) + ' est inférieur à l\'heure de fin de la tranhe ' + (index - 1));
                test = true;
                break;
            }

        }
    }

    if (!test && nbre != 0) {
        var conf = confirm('cette action changera les anciennes tranches horaire et supprimera les emplois de temps actuel!!! Voulez-vous continuer?')
        if (conf) {
            $.post(url, data, function(data) {
                alert(data);
            })
        }

    }


});


// groupe de matières

//

$('#remove-scroll #mat #new-groupe').on('click', function(e) {
    $('#Groupe_matiere #formulaire-taux #liste-filier option').remove();
    var url = '/liste/filiere';
    var option;
    $.get(url, function(data) {
        option = $('<option/>', {
            text: '',
        });
        $('#Groupe_matiere #formulaire-taux #liste-filier').append(option);
        for (var index = 0; index < data.length; index++) {
            option = $('<option/>', {
                text: data[index].nom + '=>' + data[index].code,
                val: data[index].id,
            });
            $('#Groupe_matiere #formulaire-taux #liste-filier').append(option);
        }


    })
});


//titulaire
$(document).on('click', '#ajouter_titu', function(e) {
    var id = $(this).data('id');
    var classe = $(this).data('classe');
    $('#classe_rechargeable').val(classe);
    $('#ident').val(id);
});

$(document).on('submit', '#form_titulaire', function(e) {
    e.preventDefault();
    var data_send = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, data_send, function(data) {

        switch (data) {
            case '1':
                alert('professeur titulaire ajouté avec succès');
                break;
            case '2':
                test = confirm('le professeur sélectionné est déjà titulaire d\'une autre classe. voulez vous le supprimer de l\'ancienne classe pour l\'ajouter à la nouvelle?');
                url = '/enlever_ajouter titulaires';
                if (test) {
                    $.get(url, data_send, function(data) {
                        if (data == 1) {
                            alert('professeur titulaire ajouté avec succès');
                        } else {
                            alert('erreur');
                        }
                    });
                }
                break;
            case '3':
                var test = confirm('cette salle de classe possède déjà un titulaire. voulez vous la changer?');
                if (test) {
                    url = '/modifier titulaires';
                    $.get(url, data_send, function(data) {
                        switch (data) {
                            case '1':
                                alert('titulaire modifier avec succès');
                                break;

                            case '2':
                                test = confirm('le professeur sélectionné est déjà titulaire d\'une autre classe. voulez vous le supprimer de l\'ancienne classe pour l\'ajouter à la nouvelle?');
                                url = '/enlever_ajouter titulaires';
                                if (test) {
                                    $.get(url, data_send, function(data) {
                                        if (data == 1) {
                                            alert('professeur titulaire ajouté avec succès');
                                        } else {
                                            alert('erreur');
                                        }
                                    });
                                }

                                break;

                            default:
                                alert('érreur');
                                break;
                        }
                    });
                }
                break;

            default:
                alert('erreur')
                break;
        }
    });
});


$(document).on('click', '#voir_ti', function(e) {
    $('#classe_titu').val($(this).data('classe'));
    var id = $(this).data('id');
    var url = '/recharcher titulaires';
    $.get(url, { id: id }, function(data) {
        if (data.length == 1) {
            if (data[0].sexe == 'Masculin') {
                var sexe = 'M. '
            } else {
                var sexe = 'Mme. '
            }
            $('#voir_tit').val(sexe + data[0].nom + ' ' + data[0].prenom);
        } else {
            $('#voir_tit').val('cette classe ne dispose pas de titulaire pour le moment.');
        }

    });
});


$(document).on('click', '#supp_ti', function(e) {
    var conf = confirm('voulez vous vraiment retirer ce titulaire?')
    if (conf) {
        var id = $(this).data('id');
        var url = '/supprimer titulaires';
        $.get(url, { id: id }, function(data) {
            if (data == 1) {
                alert('titulaire supprimé avec succès');
            } else {
                alert('cette classe ne dispose pas de titulaire.');
            }
        });
    }
});


//moratoire


$('#tableetudiants #voir-etu-mora').on('click', function(e) {
    var url = '/Liste_etudiants';
    var classe = $(this).data('id');
    var id_classe = $(this).data('id_classe');
    var id_fil = $(this).data('filiere');


    $(this).replaceWith('Veuillez patienter...');

    $.post(url, { classe: classe }, function(data) {


        if (data.length <= 0) {
            alert('Aucun étudiant dans cette salle de classe');
        } else {

            $('#title #b').remove();
            $('#title ').append($('<b/>', {
                text: 'liste des étudiants de la ' + data[0].classe,
            }))

            $('#tableetudiants #entete').remove();
            $('#tableetudiants #corps').remove();
            var table = $('<thead > <th>Numèro</th>  <th>Matricule</th> <th>Nom</th><th>Prenom</th> <th>classe</th><th>sexe</th><th>date de naissance</th>' +
                '<th class="ne_pas_imprimer">Manipulations</th> </tr></thead>');
            table.append($('<tbody>'))
            for (var index = 0; index < data.length; index++) {
                table.append($('<tr/>', {
                    id: index + 1
                })).append($('<td/>', {
                    text: index + 1
                })).append($('<td/>', {
                    text: data[index].matricule
                })).append($('<td/>', {
                    text: data[index].nom
                })).append($('<td/>', {
                    text: data[index].prenom
                })).append($('<td/>', {
                    text: data[index].classe
                })).append($('<td/>', {
                    text: data[index].sexe
                })).append($('<td/>', {
                    text: data[index].naissance
                })).append($('<td/>', {
                    html: '<a href="Moratoire-liste-tranches?filiere=' + id_fil + '&id=' + data[index].id + '&classe=' + data[index].classe + '&matricule=' + data[index].matricule + '"><code class="badge badge-error" >Moratoire</code></a>  ',

                    class: 'ne_pas_imprimer'
                }));


            }
            table.append($('<tr/>', {
                html: '<td colspan="8"><a href="" id="lien"><input type="button" class="btn btn-success" button value="OK"></a>',
                class: 'ne_pas_imprimer'

            }))
            $('#tableetudiants').append(table);
        }

    })
});


//

$(document).on('click', '#moratoire', function(e) {
    $('#valider').click();
    $('#anc-date').val($(this).data('date'));
    $('#id-elev').val($(this).data('id'));
    $('#nom_tranche').val($(this).data('moratoire_lib'));
    $('#anc-dat').val($(this).data('date'));
    $('#classe').val($(this).data('classe'));
    $('#matric').val($(this).data('matricule'));
});


//payer moratoire

$(document).on('submit', '#form_moratoire', function(e) {
    $('#submit').replaceWith('<input id="submit" value="Patienter..." class="left btn btn-success">')

    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();

    $.post(url, data, function(data) {
        alert(data);
        window.location.reload();
    })
})