jQuery(document).ready(function($) {
    // single msg
    $(".send_cronjob_ten_msg").click(function() {
        var campID = jQuery(this).attr('data-postID');  
        var message_sel = $('select[name=message_'+campID+'] option').filter(':selected');
        var message_data = message_sel.data("msg");
        console.log(message_data);
       var phone = jQuery(this).attr('data-phone');  
       var campTitle = jQuery(this).attr('data-campTitle');  
       var pageurl = jQuery(this).attr('data-pagurl'); 
       window.location.href = pageurl+'?message_content='+message_data+'&postID='+campID+'&campagin_title='+campTitle+'&phone='+phone; // Replace with your desired URL
    });
    // single msg send
    $('.send_cronjob_ten_single').click(function(){
        jQuery('#phone-sent').removeClass('d-none');
        jQuery('#phone-sent').addClass('d-flex');
        var phone = jQuery(this).attr('data-phone');  
        var campaign = jQuery(this).attr('data-url');  
        var ph_num = phone.replace('(', '').replace(')', '').replace(/ /g,'').replace('+1', '');
        var message_data = jQuery(this).attr('data-msg')
        // var message_data = $('select[name=message_'+ph_num+'] option').filter(':selected').val()
        
        var data_val = {
            action: 'single_tenmsg_sent',
            phone: ph_num,
            campaign: campaign,
            // organization: organization,
            message_data: message_data
        };

        try {
            $.ajax({
              url: ajaxurl,
              type: 'POST',
              data: data_val, // Replace with your actual data
          
              success: function(response) {
                // Handle successful response
                console.log('Success:', response);
                var res = JSON.parse(response);
                if(res.status == 200){
                    alert(res.message);
                }else {
                    alert(res.message);
                }
              },
          
              error: function(xhr, status, error) {
                // Handle any errors, including exceptions
                // console.error('Failed to Sent Invalid Number!!!...');
                alert('Failed to Sent Invalid Is Number!!!...');
              }
            });
        } catch (err) {
            // Catch and handle the exception
            // console.error('Failed!!...');
            alert('Failed!!...');
        }
            jQuery('#phone-sent').removeClass('d-flex');
            jQuery('#phone-sent').addClass('d-none');
          
        // $.post(ajaxurl, data, function(response) {
        //     var res = JSON.parse(response);
        //     console.log(res);
        //     if(res.status == 200){
        //         alert(res.message);

        //     }else {
        //         alert(res.message);
        //     }
        //     jQuery('#phone-sent').removeClass('d-flex');
        //     jQuery('#phone-sent').addClass('d-none');
        // });
    });
    // multiple msg send
    $('.send_all_msg_ten').click(function() {
        jQuery('#phone-sent').removeClass('d-none');
        jQuery('#phone-sent').addClass('d-flex');
        var msg_content = jQuery(this).attr('data-msg');  
        var phone_data = jQuery("#form_results10 tr td:nth-child(2)");       
        var campaign_title = jQuery("#form_results10 tr td:nth-child(3)");
        var phone = [];
        var camp_title = [];
        campaign_title.map((index, element) => {
            camp_title.push(element.innerText);
        });
        phone_data.map((index, element) => {
            phone.push(element.innerText);
        });
        console.log(phone);
        var data = {};
        // if(msg_content == 'message1'){
            data = {
                action: 'send_message_ten_all',
                phone: JSON.stringify(phone),
                campaign_title: JSON.stringify(camp_title),
                message_key: msg_content
            };
        // }else if (msg_content == 'message2'){
        //     data = {
        //         action: 'send_message_ten_two',
        //         phone: JSON.stringify(phone),
        //         campaign_title: JSON.stringify(camp_title),
        //         message_key: msg_content
        //     };
        // }else if (msg_content == 'message3'){
        //     data = {
        //         action: 'send_message_ten_three',
        //         phone: JSON.stringify(phone),
        //         campaign_title: JSON.stringify(camp_title),
        //         message_key: msg_content
        //     };
        // }else if (msg_content == 'message4'){
        //     data = {
        //         action: 'send_message_ten_four',
        //         phone: JSON.stringify(phone),
        //         campaign_title: JSON.stringify(camp_title),
        //         message_key: msg_content
        //     };
        // }else if (msg_content == 'message5'){
        //     data = {
        //         action: 'send_message_ten_five',
        //         phone: JSON.stringify(phone),
        //         campaign_title: JSON.stringify(camp_title),
        //         message_key: msg_content
        //     };
        // }

        $.post(ajaxurl, data, function(response) {
            var res = JSON.parse(response);
            if(res.status == 200){
                alert(res.message);
            }else {
                alert(res.message);
            }
            jQuery('#phone-sent').removeClass('d-flex');
            jQuery('#phone-sent').addClass('d-none');
        });
    });

});