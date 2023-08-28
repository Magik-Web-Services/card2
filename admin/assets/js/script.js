$(document).ready(function () {



    // Data tables

    $('#myTable').DataTable({});



    // User



    // editUser

    jQuery(document).on('click', '.edituser', function () {

        jQuery('#save_btn').addClass("d-none")

        jQuery('#edit_btn').removeClass("d-none")

        jQuery('#user_id').val(jQuery(this).attr('id'));

        if (jQuery.trim(jQuery(this).parent().parent().parent().find('td')[0].innerText)) {

            jQuery('#user-name').val(jQuery.trim(jQuery(this).parent().parent().parent().find('td')[0].innerText));

        }

        if (jQuery.trim(jQuery(this).parent().parent().parent().find('td')[1].innerText)) {

            jQuery('#user-email').val(jQuery.trim(jQuery(this).parent().parent().parent().find('td')[1].innerText));

        }

        if (jQuery.trim(jQuery(this).parent().parent().parent().find('td')[2].innerText)) {

            jQuery('#user-country').val(jQuery.trim(jQuery(this).parent().parent().parent().find('td')[2].innerText)).change();

        }

        if (jQuery.trim(jQuery(this).parent().parent().parent().find('td')[3].innerText)) {

            jQuery('#user-role').val(jQuery.trim(jQuery(this).parent().parent().parent().find('td')[3].innerText)).change();

        }

    });



    // deleteUser

    let deleteUser = jQuery('.deleteUser');

    Array.from(deleteUser).forEach(element => {

        element.addEventListener("click", (e) => {

            sno = e.target.id



            if (confirm("Are you sure you want to delete this User!")) {

                window.location = `./delUser.php?userDelete=${sno}`;

            }

        })

    })

    // cards

    // editCards

    let editcard = jQuery('.editcard');

    Array.from(editcard).forEach(element => {

        element.addEventListener("click", (e) => {
            event.preventDefault();
            sno = e.target.id

            window.location = `editCard.php?editcard=${sno}`;
            $('#cardModal').show()
        })
    })

    // deleCards

    let deleuser = jQuery('.delCard');

    Array.from(deleuser).forEach(element => {

        element.addEventListener("click", (e) => {
            sno = e.target.id
            if (confirm("Are you sure you want to delete this Card!")) {
                window.location = `./delCard.php?cardDelete=${sno}`;
            }
        })
    })

    // Add new row

    $(document).on('click', '#Addline', function () {

        var listitems_c = jQuery('#item_count').val();

        listitems_c = parseInt(listitems_c) + 1;

        jQuery('#item_count').val(listitems_c);

        var extend_items = `

<tr class="listitems" id="itemId_${listitems_c}">

<td>

<input type="hidden" id="item_name_${listitems_c}" name="name[]">

<select class="selItem" id="item_item_${listitems_c}" style='width: 200px;'>

<option disabled value='0'>- Search Item -</option>

</select>

</td>

<td><input onchange="calculate(this)" id="item_qty_${listitems_c}" class="qty" name="qty[]" type="number" value="1" name="qty"></td>

<td><input id="item_unit_${listitems_c}" class="unit" readonly type="text" name="unit[]"></td>

<td><input onchange="calculate(this)" readonly id="item_rate_${listitems_c}" class="rate" type="number" value="0" name="rate[]"></td>

<td><input onchange="calculate(this)" readonly id="item_amount_${listitems_c}" class="amount" type="number" value="0" name="amount[]"></td>

<td><input id="item_delete_${listitems_c}" type="button" value="delete" onclick="deleteRow(this)" /></td>

</tr>

`;



        jQuery('#employee-table tbody').append(extend_items);

        Ajax()

    });

})









function calculate(id) {



    let item_id = id.id,

        split_id = item_id.split("_"),

        select_field = split_id[1],

        select_id = split_id[2],

        qty = jQuery('#item_qty_' + select_id).val() ? jQuery('#item_qty_' + select_id).val() : 0,

        rate = jQuery('#item_rate_' + select_id).val() ? jQuery('#item_rate_' + select_id).val() : 0

    // amount = jQuery('#item_amount_' + select_id).val() ? jQuery('#item_amount_' + select_id).val() : 0;



    if (select_field) {

        switch (select_field) {

            case 'qty':

                var price = qty * rate;

                jQuery('#item_amount_' + select_id).val((price).toFixed(2));

                break;

            case 'rate':

                var total_unit = qty * rate

                jQuery('#item_amount_' + select_id).val(total_unit.toFixed(2));

                break;

            case 'item':

                jQuery('#item_amount_' + select_id).val(rate);

                break;

            default:

        }

    }



    var each_item_price = 0;

    jQuery('.amount').each(function () {

        each_item_price += parseFloat(jQuery(this).val());

    });

    jQuery('#Sub_Total').val(each_item_price);

    jQuery('#total').val(each_item_price);

    calculate2();

}



function calculate2(id) {

    let calculate2_id = id;

    if (calculate2_id == 'undefined') {

        console.log("calculate21");

        let item_id = id.id,

            Sub_Total = jQuery('#Sub_Total').val() ? jQuery('#Sub_Total').val() : 0,

            Discount = jQuery('#Discount').val() ? jQuery('#Discount').val() : 0,

            Adjustment = jQuery('#Adjustment').val() ? jQuery('#Adjustment').val() : 0,

            tax = jQuery('#selectTax').find(':selected').val()



        if (item_id) {

            switch (item_id) {

                case 'Discount':

                    switch (tax) {

                        case '$':

                            let discount$ = parseInt(Sub_Total) - parseInt(Discount) + parseInt(Adjustment);

                            jQuery('#total').val(discount$);

                            break;

                        case '%':

                            let dis = parseInt(Sub_Total) - (((parseInt(Sub_Total) * parseInt(Discount)) / 100)) + parseInt(Adjustment);

                            jQuery('#total').val(dis);

                            break;

                        default:

                            break;

                    }

                    break;

                case 'Adjustment':

                    var Dis = (tax == "%") ? (parseInt(Sub_Total) - ((parseInt(Sub_Total) * parseInt(Discount)) / 100) + parseInt(Adjustment)) : (parseInt(Sub_Total) - parseInt(Discount) + parseInt(Adjustment))



                    jQuery('#total').val(Dis);

                    break;

            }

        }

    } else {

        Sub_Total = jQuery('#Sub_Total').val() ? jQuery('#Sub_Total').val() : 0,

            Discount = jQuery('#Discount').val() ? jQuery('#Discount').val() : 0,

            Adjustment = jQuery('#Adjustment').val() ? jQuery('#Adjustment').val() : 0,

            tax = jQuery('#selectTax').find(':selected').val()

        var Dis = (tax == "%") ? (parseInt(Sub_Total) - ((parseInt(Sub_Total) * parseInt(Discount)) / 100) + parseInt(Adjustment)) : (parseInt(Sub_Total) - parseInt(Discount) + parseInt(Adjustment))



        jQuery('#total').val(Dis);

    }

}



