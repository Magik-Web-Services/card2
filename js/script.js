// func
let not_allowed_save_btn = () => {
    jQuery('#btn_save').removeClass('btn_save');
    jQuery('#btn_save').addClass('poppup_btn');
    jQuery('#btn_save').attr('data-bs-dismiss', 'modal');
    jQuery('#btn_save').attr('id', 'save_btn');
}

let remove_not_allowed_save_btn = () => {
    jQuery('#save_btn').addClass('btn_save');
    jQuery('#save_btn').removeClass('poppup_btn');
    jQuery('#save_btn').attr('data-bs-dismiss', '');
    jQuery('#save_btn').attr('id', 'btn_save');
}

// profile

// Personal data save
jQuery(document).ready(function () {
    jQuery(document).on('click', '.profile_con', function () {
        var id = jQuery(this).data('id');
        var box = jQuery(this).data('box');
        jQuery('#delete_icon').removeAttr('data-smID');
        jQuery('#delete_icon').removeAttr('data-smBox');
        jQuery('#delete_icon').attr('data-perID', id);
        jQuery('#delete_icon').attr('data-perBox', box);

        var field = jQuery('.ps_hidden')
        var lenField = field.length

        for (let index = 0; index < lenField; index++) {
            const element = field[index];

            let dfied = jQuery(element).attr('data-hidden');
            let dvalue = jQuery(element).val();

            jQuery('#'+dfied).val(dvalue);
        }

        jQuery(document).on('click', '#delete_icon', function () {
            let perbox = jQuery(this).attr('data-perBox');

            jQuery('.active').css('display', 'none');
            jQuery('#remove_field').css('display', 'block');
            // 
            jQuery('#modal_footer').css('display', 'none');
            jQuery('#remove_footer').css('display', 'flex');

            // cancel btn
            jQuery(document).on('click', '#remove_cancel', function () {
                jQuery('.active').css('display', 'block');
                jQuery('#remove_field').css('display', 'none');
                // 
                jQuery('#modal_footer').css('display', 'flex');
                jQuery('#remove_footer').css('display', 'none');
            })

            // remove btn
            jQuery(document).on('click', '#remove_btn', function () {
                jQuery('*[data-input="' + perbox + '"]').val('')
                jQuery('*[data-Tfield="' + perbox + '"]').text('')
                jQuery('*[data-Hfield="' + perbox + '"]').val('')
                jQuery('*[data-con="' + perbox + '"]').css('display', 'none')
                jQuery('*[data-con2="' + perbox + '"]').remove()
                jQuery('.extra_text').css('display', 'none')
                // 
                $('*[data-box1="' + perbox + '"]').removeClass("box_none")
                $('*[data-box1="' + perbox + '"]').attr("data-bs-toggle", "modal")
                $('*[data-box1="' + perbox + '"] svg').removeClass('svg_none')
                // 
                jQuery('#modal_footer').css('display', 'flex');
                jQuery('#remove_footer').css('display', 'none');
                // 
                remove_not_allowed_save_btn()
            })
        })
    })

    jQuery(document).on('keyup', '.updown input ', function () {
        var value = jQuery(this).val();
        var id = jQuery(this).attr('id');
        var dataID = jQuery(this).attr('data-input');
        // not_allowed_save_btn
        not_allowed_save_btn()

        // Save Btn
        jQuery(document).on('click', '#save_btn', function () {
            jQuery(".valHidden").each(function () {
                if (jQuery(this).attr("data-hidden") == id) {
                    jQuery('*[data-hidden="' + id + '"]').val(value)
                }
            })

            var hidden = jQuery(".valHidden").data('hidden');
            let len = jQuery(`*[data-hidden = "${id}"]`).length
            if (hidden == undefined && len == 0) {
                let ps_con = jQuery('#ps_con');
                var hiddenele = `<input type="hidden" class="valHidden" data-Hfield="${dataID}" name="profile[${$.trim(dataID)}][${$.trim(id)}]" data-hidden="${id}">`;
                var hiddenele2 = `<input type="hidden" class="valHidden" name="profile[${$.trim(dataID)}][dataid]" value="${$.trim(dataID)}">`;
                ps_con.append(hiddenele)
                ps_con.append(hiddenele2)
            }

            // display none
            // if (value == '') {
            //     jQuery('*[data-con="' + dataID + '"]').css('display', 'none')
            // }
            // add not_allowed box
            $('*[data-box1="' + dataID + '"]').addClass("box_none")
            $('*[data-box1="' + dataID + '"]').removeAttr("data-bs-toggle")
            $('*[data-box1="' + dataID + '"] svg').addClass('svg_none')
            remove_not_allowed_save_btn()
        })

        jQuery(".field_card").each(function () {

            if (jQuery(this).data("text1") == id) {
                // display block
                jQuery('*[data-con="' + dataID + '"]').css('display', 'block')
                // Add text
                jQuery('*[data-text1="' + id + '"]').text(value)

                // text none and show
                jQuery(".extra_text").each(function () {
                    if (jQuery(this).data("extra") == id) {
                        jQuery('#extra_' + id).removeClass('d-none')
                        jQuery('#extra_' + id).css('display', 'inline')
                    }
                })

                // Cancel Btn
                jQuery(document).on('click', '#cancel_btn', function () {
                    // remove text
                    let hiddenVal = jQuery('*[data-hidden="' + id + '"]').val()
                    jQuery('#' + id).val(hiddenVal);
                    jQuery('*[data-text1="' + id + '"]').text(hiddenVal)
                    // display none
                    if (hiddenVal == '' || hiddenVal == undefined) {
                        jQuery('*[data-con="' + dataID + '"]').css('display', 'none')
                    }
                    // remove_not_allowed_save_btn
                    remove_not_allowed_save_btn()
                })
                // Save Btn
                jQuery(document).on('click', '#save_btn', function () {
                    jQuery(".valHidden").each(function () {
                        if (jQuery(this).attr("data-hidden") == id) {
                            jQuery('*[data-hidden="' + id + '"]').val(value)
                        }
                    })

                    var hidden = jQuery(".valHidden").data('hidden');
                    let len = jQuery(`*[data-hidden = "${id}"]`).length
                    if (hidden != undefined && len == 0) {
                        let ps_con = jQuery('#ps_con');
                        var hiddenele = `<input type="hidden" class="valHidden" data-Hfield="${dataID}" name="profile[${$.trim(dataID)}][${$.trim(id)}]" data-hidden="${id}">`;
                        var hiddenele2 = `<input type="hidden" class="valHidden" name="profile[${$.trim(dataID)}][dataid]" value="${$.trim(dataID)}">`;
                        ps_con.append(hiddenele)
                        ps_con.append(hiddenele2)
                    }

                    // display none
                    // if (value == '') {
                    //     jQuery('*[data-con="' + dataID + '"]').css('display', 'none')
                    // }
                    // add not_allowed box
                    $('*[data-box1="' + dataID + '"]').addClass("box_none")
                    $('*[data-box1="' + dataID + '"]').removeAttr("data-bs-toggle")
                    $('*[data-box1="' + dataID + '"] svg').addClass('svg_none')
                    remove_not_allowed_save_btn()
                })
            }
        })
    })
})

// const Ajax = (data) => {
//     $.ajax({
//         url: "saveData.php",
//         method: "POST",
//         data: { data: data },
//         success: function () {
//             alert("save Data");
//             // window.location.reload();
//         }
//     })
// }


// get data
// $(document).ready(function () {
//     $("#Submit").click(function () {
//         event.preventDefault();
//         let data = $("form").serialize();
//         Ajax(data)
//     });
// });
// social media data save

jQuery(document).ready(function () {

    jQuery(document).on('click', '.sm_con2', function () {
        var id = jQuery(this).data('id');
        var dataID = jQuery(this).data('box');

        jQuery('#delete_icon').removeAttr('data-perID');
        jQuery('#delete_icon').removeAttr('data-perBox');
        jQuery('#delete_icon').attr('data-smID', id);
        jQuery('#delete_icon').attr('data-smBox', dataID);

        jQuery(document).on('click', '#delete_icon', function () {
            let smbox = jQuery(this).attr('data-smBox');

            jQuery('.active').css('display', 'none');
            jQuery('#remove_field').css('display', 'block');
            // 
            jQuery('#modal_footer').css('display', 'none');
            jQuery('#remove_footer').css('display', 'flex');

            // cancel btn
            jQuery(document).on('click', '#remove_cancel', function () {
                jQuery('.active').css('display', 'block');
                jQuery('#remove_field').css('display', 'none');
                // 
                jQuery('#modal_footer').css('display', 'flex');
                jQuery('#remove_footer').css('display', 'none');
            })

            // remove btn
            jQuery(document).on('click', '#remove_btn', function () {
                jQuery('*[data-input="' + smbox + '"]').val('')
                jQuery('*[data-Tfield="' + smbox + '"]').text('')
                jQuery('*[data-Hfield="' + smbox + '"]').val('')
                jQuery('*[data-con="' + smbox + '"]').css('display', 'none')
                jQuery('*[data-con2="' + smbox + '"]').remove()
                jQuery('.extra_text').css('display', 'none')
                // 
                $('*[data-box1="' + smbox + '"]').removeClass("box_none")
                $('*[data-box1="' + smbox + '"]').addClass("sm_box")
                $('*[data-box1="' + smbox + '"]').attr("data-bs-toggle", "modal")
                $('*[data-box1="' + smbox + '"] svg').removeClass('svg_none')
                // 
                jQuery('#modal_footer').css('display', 'flex');
                jQuery('#remove_footer').css('display', 'none');
                // 
                remove_not_allowed_save_btn()
            })
        })
    })

    jQuery(document).on('click', '.sm_box', function () {
        var id = jQuery(this).data('id');
        var val1 = jQuery(this).data('val1');
        var val2 = jQuery(this).data('val2');
        var dataID = jQuery(this).data('box');
        let sm_con = jQuery("#sm_con")
        let svg = jQuery(this).find("svg").html();

        let text1 = jQuery('*[data-id="' + id + '"] .social_media_para_con .card_text1').text()
        let text2 = jQuery('*[data-id="' + id + '"] .social_media_para_con .card_text2').text()

        jQuery("#" + val1).val(text1);
        jQuery("#" + val2).val(text2);

        let len = jQuery("#" + dataID).length


        if (len == 0) {
            let data = `
            <div class="social_media modal_open social_media_con sm_con2 mb-3" data-con2="${dataID}" data-box="${dataID}" data-id="${id}" id="${dataID}"
                data-bs-toggle="modal" data-bs-target="#fildetail">
                <span class="social_media_icon d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" style="width: 30px;"
                        class="card_svg">
                        ${svg}
                    </svg>
                </span>
                <span class="social_media_para_con ms-3">
                    <div class="social_media_para card_text1 fs-7 fw-bold lh-2" data-Text="${val1}"></div>
                    <input class="valHidden" data-hidden="${val1}" name="socail[${$.trim(dataID)}][heading]" type="hidden">
                    <div class="social_media_para card_text2 fs-7 lh-1 fw-lighter" data-Text="${val2}"></div>
                    <input class="valHidden" data-hidden="${val2}" name="socail[${$.trim(dataID)}][subheading]" type="hidden">

                    <input class="valHidden" name="socail[${$.trim(dataID)}][svg]" value="${$.trim(dataID)}" type="hidden">
                    <input class="valHidden" name="socail[${$.trim(dataID)}][id]" value="${$.trim(id)}" type="hidden">
                    <input class="valHidden" name="socail[${$.trim(dataID)}][val1]" value="${$.trim(val1)}" type="hidden">
                    <input class="valHidden" name="socail[${$.trim(dataID)}][val2]" value="${$.trim(val2)}" type="hidden">
                </span>
                <i class="card_edit fa-solid fa-pen-to-square"></i>
            </div> `;

            sm_con.append(data)

            jQuery(document).on('click', '#cancel_btn ', function () {
                let hiddenVal1 = jQuery('*[data-hidden="' + val1 + '"]').val()
                let hiddenVal2 = jQuery('*[data-hidden="' + val2 + '"]').val()
                if (hiddenVal1 == '' && hiddenVal2 == '') {
                    jQuery('*[data-con2="' + dataID + '"]').remove();
                }
            })
        }


        jQuery(document).on('keyup', '.updown input', function () {
            var value = jQuery(this).val();
            var id = jQuery(this).attr('id');
            var dataID = jQuery(this).attr('data-input');
            // not_allowed_save_btn
            not_allowed_save_btn()
            // add text
            jQuery(".social_media_para_con").each(function () {
                jQuery('[data-Text="' + id + '"]').text(value)
                jQuery('[data-Text="' + id + '"]').text(value)
            })

            // Cancel Btn
            jQuery(document).on('click', '#cancel_btn ', function () {
                let hiddenVal = jQuery('*[data-hidden="' + id + '"]').val()
                // remove text
                jQuery('#' + id).val(hiddenVal);
                jQuery('*[data-Text="' + id + '"]').text(hiddenVal)
                // display none
                // if (hiddenVal == '') {
                //     jQuery('*[data-con="' + dataID + '"]').css('display', 'none')
                //     jQuery('#' + dataID).remove()
                //     jQuery('[data-input="' + dataID + '"]').val('')
                // }
                // remove_not_allowed_save_btn
                remove_not_allowed_save_btn()
            })

            // Save Btn
            jQuery(document).on('click', '#save_btn', function () {
                jQuery('*[data-box="' + dataID + '"]').removeClass('sm_box')
                jQuery(".valHidden").each(function () {
                    if (jQuery(this).attr("data-hidden") == id) {
                        jQuery('*[data-hidden="' + id + '"]').val(value)
                    }
                })
                // add not_allowed box
                let ele = jQuery('.active').attr('id')
                let box = jQuery('#' + ele + " .updown input").attr('data-input')
                jQuery('*[data-box1="' + box + '"]').addClass("box_none")
                jQuery('*[data-box1="' + box + '"]').removeAttr("data-bs-toggle")
                jQuery('*[data-box1="' + box + '"] svg').addClass('svg_none')
                remove_not_allowed_save_btn()
            })
        })
    })
})

// Show More
jQuery(document).on('click', '#name_more', function () {
    jQuery('.name_hidden').css('display', 'block')
    jQuery('#name_more').css('display', 'none')
})



// profile input

jQuery(document).ready(function () {

    jQuery(document).on('click', '.modal_open', function () {
        var iconid = jQuery(this).data('id');
        // var iconbox = jQuery(this).data('box');
        jQuery(".field_box").each(function () {
            if (jQuery(this).attr('id') === iconid) {
                jQuery(this).css("display", "block");
                jQuery(this).addClass("active");
            }
            else {
                jQuery(this).css("display", "none");
                jQuery(this).removeClass("active");
            }
        });
    });
});

jQuery(document).on('focusin', '.updown input ', function () {
    jQuery(this).parent().find('label').addClass('shift');
    jQuery(this).parent().addClass('wrap_shift');
    // if(jQuery(this).val() === ''){
    // jQuery(this).parent().addClass('brdr_red');
    // jQuery(this).parent().removeClass('brdr_green');
    // }
    // else{
    // jQuery(this).parent().addClass('brdr_green');
    // jQuery(this).parent().removeClass('brdr_red');
    // }
});

jQuery(document).on('focusout', '.updown input', function () {
    if (jQuery(this).val() === '') {
        jQuery(this).parent().find('label').removeClass('shift');
        jQuery(this).parent().removeClass('wrap_shift');
    }
});



jQuery(document).ready(function () {
    jQuery(".label_suggestion .class").click(function () {
        // jQuery(this).removeClass("active");
        jQuery(this).addClass("active");
    });
});



// Add Imges
// Company
function readURL(input) {
    if (input.files && input.files[0]) {
        $('.img-con').css('display', 'block')
        var reader = new FileReader();
        reader.onload = function (e) {
            let data = e.srcElement.result;
            jQuery('#Hcompanyimg').attr('name', 'images[Company]')
            jQuery('#Hcompanyimg').val(data)
            $('#uploadlogo').attr('src', e.target.result);
            $('#company-img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Profile
function readURL2(input) {
    if (input.files && input.files[0]) {
        $('.img-con2').css('display', 'block')
        var reader = new FileReader();
        reader.onload = function (e) {
            let data = e.srcElement.result;
            jQuery('#HProfileimg').attr('name', 'images[Profile]')
            jQuery('#HProfileimg').val(data)
            $('#uploadlogo2').attr('src', e.target.result);
            $('#profile-img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Cover
function readURL3(input) {
    if (input.files && input.files[0]) {
        $('.img-con3').css('display', 'block')
        var reader = new FileReader();
        reader.onload = function (e) {
            let data = e.srcElement.result;
            jQuery('#Hcoverimg').attr('name', 'images[Cover]')
            jQuery('#Hcoverimg').val(data)
            $('#uploadlogo3').attr('src', e.target.result);
            $('#cover-img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


// 

$(document).ready(function () {
    $(".next").click(function () {
        let bar = $(this).data("step");
        // 
        $('.comman').removeClass('active1');
        $('.step' + bar).addClass("active1");
        $('.next_icon' + bar).addClass("right_top_box");
        $('.next_icon' + bar).addClass("next");
    })
    $(".next_icon1").click(function () {
        $('.comman').removeClass('active1');
        $('.step1').addClass("active1");
        $('.right_top_icon').css('cursor', 'default')
        $('.next_icon2').removeClass("right_top_box");
    })
})