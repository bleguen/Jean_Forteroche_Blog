// Effet Smoothscroll sur le bouton voir tout les chapitres 

$(document).ready(function() {
    $('#allChapter').on('click', function() { // Au clic sur un élément
        var page = $(this).attr('href'); // Page cible
        var speed = 1500; // Durée de l'animation (en ms)
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
        return false;
    });
    
    // TEST JS à EFFECTUER
    
    var Connexion = {
        input: function(e) {

            if(($('input[name*="username"]').val() !== "") && ($('input[name*="passwordHash"]').val() !== "")) {
                $('#validConnex').submit();
            } else {
                e.preventDefault();
                $('#champs').css('display', 'block');
                $('#champs').text("Veuillez remplir tout les champs !");
            }
        }
    };


    var Inscription = {
        regexUsername: new RegExp("^[a-zA-Z0-9_]{5,16}$"),
        regexPasswordOne:new RegExp("^[a-zA-Z0-9_]{8,25}$"),
        regexPasswordTwo: new RegExp("[A-Z]+"),
        regexPasswordThree: new RegExp("[0-9]+"),
        regexEmail: new RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)+$"),
        username: function(e) {
            e.preventDefault();
            $('.unvalidUsername').css('display', 'block');
            $('.unvalidPassword, .unvalidPasswordSecond, #validInscrip, .unvalidEmail').css('display', 'none');
            $('.unvalidUsername').text("Votre pseudo doit contenir au minimum 5 charactères !");
        },

        password: function(e) {
            e.preventDefault();
            $('.unvalidPassword').css('display', 'block');
            $('.unvalidUsername, .unvalidPasswordSecond, #validInscrip, .unvalidEmail').css('display', 'none');
            $('.unvalidPassword').text("Votre mot de passe doit contenir 8 charactères au minimum et 25 au maximum avec une majuscule, un nombre !");
        },

        passwordSecond: function(e) {
            e.preventDefault();
            $('.unvalidPasswordSecond').css('display', 'block');
            $('.unvalidUsername, .unvalidPassword, #validInscrip, .unvalidEmail').css('display', 'none');
            $('.unvalidPasswordSecond').text("Vos mots de passe ne correspondent pas !");
        },

        email: function(e) {
            e.preventDefault();
            $('.unvalidEmail').css('display', 'block');
            $('.unvalidUsername, .unvalidPassword, .unvalidPasswordSecond, #validInscrip').css('display', 'none');
            $('.unvalidEmail').text("Vérifier votre adresse e-mail !");
        },

        empty: function(e) {
            e.preventDefault();
            $('.validInscrip').css('display', 'block');
            $('.unvalidUsername, .unvalidPassword, .unvalidPasswordSecond, .unvalidEmail').css('display', 'none');
            $('.validInscrip').text("Veuillez remplir tout les champs !");
        },

        inputs: function(e) {
            
            if(($('input[name*="usernameInscrip"]').val() !== "") && ($('input[name*="passwordHashInscrip"]').val() !== "") && ($('input[name*="passwordHashSecondInscrip"]').val() !== "") && ($('input[name*="mailInscrip"]').val() !== "")) {
                 
                if(Inscription.regexUsername.test($('input[name*="usernameInscrip"]').val()) == false) {
                    Inscription.username(e);
                } else if((Inscription.regexPasswordOne.test($('input[name*="passwordHashInscrip"]').val()) == false) || (Inscription.regexPasswordTwo.test($('input[name*="passwordHashInscrip"]').val()) == false) || (Inscription.regexPasswordThree.test($('input[name*="passwordHashInscrip"]').val()) == false)) {
                    Inscription.password(e);
                } else if(($('input[name*="passwordHashInscrip"]').val()) !== ($('input[name*="passwordHashSecondInscrip"]').val())) {
                    Inscription.passwordSecond(e);
                } else if((Inscription.regexEmail.test($('input[name*="mailInscrip"]').val())) == false) {
                    Inscription.email(e);
                } else {
                    $('#validInscription').submit();
                }
            } else {
                Inscription.empty(e);
            }
        },

        accountManagement: function(e) {
            if(($('input[name*="passwordHashInscrip"]').val() !== "")) {
                if((Inscription.regexPasswordOne.test($('input[name*="passwordHashInscrip"]').val()) == false) || (Inscription.regexPasswordTwo.test($('input[name*="passwordHashInscrip"]').val()) == false) || (Inscription.regexPasswordThree.test($('input[name*="passwordHashInscrip"]').val()) == false)) {
                    Inscription.password(e);
                } else if(($('input[name*="passwordHashInscrip"]').val()) !== ($('input[name*="passwordHashSecondInscrip"]').val())) {
                    Inscription.passwordSecond(e);
                }
            }

            if(($('input[name*="mailInscrip"]').val() !== "")) {
                if((Inscription.regexEmail.test($('input[name*="mailInscrip"]').val())) == false) {
                    Inscription.email(e);
                }
            }
        }, 

        chapterSubmit: function(e) {
            if(($('input[name*="title"]').val() == false) || ($('input[name*="mon_fichier"]').val() == false)) {
                e.preventDefault();
                $('.unvalidTitle').css('display', 'block');
                $('.unvalidTitle').text("Veuillez mettre un titre et une image !");
            }
        }, 

        
    };

    var Comments = {
        updateComment: function(e) {
            var textarea = $(this).siblings('#new_Text').val();

            if(textarea !== "") {
                $('.updateComment').submit();

            } else {
                e.preventDefault();
                $('.unvalidMessage').css('display', 'block');
                $('.unvalidMessage').text("Veuillez saisir votre message !");
            }
        },

        letComment: function(e) {
            if($('#comment_text').val() !== "") {
                $('#sendComment').submit();
            } else {
                e.preventDefault();
                $('.unvalidMessageInside').css('display', 'block');
                $('.unvalidMessageInside').text("Veuillez saisir votre message !");
            }
        }
    };

    
    
    $('#validConnex').on("click", Connexion.input);
    $('#validInscription').on("click", Inscription.inputs);
    $('.submitFormGestion').on("click", Inscription.accountManagement);
    $('.sendChapt').on("click", Inscription.chapterSubmit);
    $('.updateComment').on("click", Comments.updateComment);
    $('#sendComment').on("click", Comments.letComment);
});