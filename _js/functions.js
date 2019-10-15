// Functions
// Refresh Customer Table
function refresh() {
	$('#data tbody').remove();
	$('#request').val('cono');
	$('#requestVal').val('');
	$.post('_includes/dataview.php', function (data) {
		$('#data table').append(data);
		selectTableRow();
		savings();
	});
}
// Create event for Cost Saving btn on Customer Table
function savings() {
	$('#data .newBtn').click(function () {
		$('#costTab').show();
		getSavType();
		var tableData = $(this).closest('tr').children('td')
	    .map(function () {
	        return $(this).text();
	    }).get();
	    var props = $('thead > tr th');
	    var array = [];
	    props.each(function () { array.push($(this).text()) });
	    obj = {};
	    for (var i = 0; i < tableData.length; i++) {
	        obj[array[i]] = tableData[i];
	    }
	    $('header a[href="#cost"]').trigger("click")
    	$('#conoCost').html(obj['Comp. No.']);
    	$('#custnoCost').html(obj['Cust. No.']);
    	$('#custnameCost').html(obj['Cust. Name']);
    	$('#savingslist tbody').remove();
    	var conoCost = obj['Comp. No.'],
    		custNoCost = obj['Cust. No.'];
    	$.post('_includes/savingslist.php', {
    		cono: conoCost,
    		custno: custNoCost
    	}, function(data) {
    		if (data === "No Cost Saving Found") {
    			$('#savingslist').hide();
    			$('#newCostForm').show();
    			$('#newCostMessage').show();
    			$('#newCostMessage').html("<p>" + data + ".  Please Enter a new Cost Saving</p>");
    		} else {
    			if ($('#savingslist').is(":hidden")) {$('#savingslist').show();}
    			if ($('#newCostMessage').is(":visible")) {$('#newCostMessage').hide();}
	    		$('#savingslist').append(data);
                updateSavings();
	    	}
    	});
	});
}
function updateSavings() {
    $('.updateCostBtn').click(function () {
        $('#newCostForm').show();
        var tableData = $(this).closest('tr').children('td')
	    .map(function () {
	        return $(this).text();
	    }).get();
	    var props = $('#savingslist thead > tr th');
	    var array = [];
	    props.each(function () { array.push($(this).text()) });
	    obj = {};
	    for (var i = 0; i < tableData.length; i++) {
	        obj[array[i]] = tableData[i];
	    }
    	$('#savTypeSel').val(obj['typeID']);
    	$('#dept').val(obj['Department']);
    	$('#description').val(obj['Description']);
    	$('#cshedID').val(obj['cshedID']);
    })
}
// Create event for Update btn on Customer Table
function selectTableRow() {
	$('#data .updateBtn').click(function () {
		$('#updateTab').show();
	    var tableData = $(this).closest('tr').children('td')
	    .map(function () {
	        return $(this).text();
	    }).get();
	    var props = $('thead > tr th');
	    var array = [];
	    props.each(function () { array.push($(this).text()) });
	    obj = {};
	    for (var i = 0; i < tableData.length; i++) {
	        obj[array[i]] = tableData[i];
	    }
	    console.log(obj);
	    var repNO = '[value="' + obj['RepNo'] + '"]';
	    $('header a[href="#update"]').trigger("click")
    	$('#conoUpdate').html(obj['Comp. No.']);
    	$('#custnoUpdate').html(obj['Cust. No.']);
    	$('#custnameUpdate').val(obj['Cust. Name']);
    	$('#contactUpdate').val(obj['Contact']);
    	$('#addressUpdate').val(obj['Address']);
    	$('#cityUpdate').val(obj['City']);
    	$('#stateUpdate').val(obj['State']);
    	$('#zipUpdate').val(obj['Zip']);
    	$('#repUpdate').val(obj['RepNo']);
	});
}
// Get Reps for select box
function getRep() {
	$.post('_includes/getRep.php', function(data) {
		$('#rep').html(data);
		$('#repUpdate').html(data);
	});
}
// Get Company Info for select box
function getCono() {
	$.post('_includes/coPull.php', function(data) {
		$('#cono').html(data);
	});
}
function getSavType() {
	$.post('_includes/savtypepull.php', function(data) {
		$('#savTypeSel').html(data);
		console.log(data);
	})
}
function newCustSub() {	
	$('#newCustData').submit(function(event) {
		event.preventDefault();

		var cono = $('#cono').val();
		var custno = $('#custno').val();
		var custname = $('#custname').val();
		var address = $('#address').val();
		var address2 = $('#address2').val();
		var city = $('#city').val();
		var state = $('#state').val();
		var zip = $('#zip').val();
		var repNo = $('#rep').val();
		var contact = $('#contact').val();

		if ($.trim(cono) != '' && $.trim(custno) != '' && $.trim(address) != '' && $.trim(city) != '' && $.trim(state) != '' && $.trim(zip) != '') {
			if ($('#inputError').is(":visible")) {$('#inputError').hide();}
			$('#inputdata input[name]').val('');
			$('#data tbody').remove();
			$.post('_includes/insert.php', {
				cono: cono,
				custno: custno,
				custname: custname,
				address: address,
				address2: address2,
				city: city,
				state: state,
				zip: zip,
				repNo: repNo,
				contact: contact
				}, function(data) {
					console.log(data);
					if (data === 'Entered data succesfully'){
						if ($('#updateError').is(":visible")) {$('#updateError').hide();}
						$('header a[href="#dataTab"]').trigger("click");
						refresh();
					} else {
						$('#updateError').show();
					}
			});
		}
		else {
			$('#inputError').show();
		}
	});
}
function filter() {	
	$('#retrieve').submit(function(event) {
		event.preventDefault();

		var request = $('#request').val();
		var requestVal = $('#requestVal').val();

		if ($.trim(requestVal) != '') {
			$('#data tbody').remove();
			$.post('_includes/find.php', {
					request: request,
					requestVal: requestVal
					}, function(data) {
						$('#data table').append(data);
						selectTableRow();
						savings();
			});
		}
	});
}
function dataUpdate() {
	$('#dataUpdate').click(function(event) {
		event.preventDefault();
		var cono = $('#conoUpdate').html();
		var custno = $('#custnoUpdate').html();
		var custname = $('#custnameUpdate').val();
		var address = $('#addressUpdate').val();
		var address2 = $('#address2Update').val();
		var city = $('#cityUpdate').val();
		var state = $('#stateUpdate').val();
		var zip = $('#zipUpdate').val();
		var repNo = $('#repUpdate').val();
		var contact = $('#contactUpdate').val();
		
		$.post('_includes/dataUpdate.php', {
			cono: cono,
			custno: custno,
			custname: custname,
			address: address,
			address2: address2,
			city: city,
			state: state,
			zip: zip,
			repNo: repNo,
			contact: contact
		}, function(data) {
			if (data === 'Data Updated Sucessfully'){
				if ($('#updateError').is(":visible")) {$('#updateError').hide();}
				$('header a[href="#dataTab"]').trigger("click");
				refresh();
				$('#updateTab').hide();
			} else {
				$('#updateError').show();
			}
		});
	});
}
function savingsRefresh() {
	$('#savingslist tbody').remove();
	var cono = $('#conoCost').html();
	var custno = $('#custnoCost').html();
	$.post('_includes/savingslist.php', {
    		cono: cono,
    		custno: custno
    	}, function(data) {
    		if (data === "No Cost Saving Found") {
    			$('#savingslist').hide();
    			$('#newCostMessage').show();
    			$('#newCostMessage').html("<p>" + data + ".  Please Enter a new Cost Saving</p>");
    		} else {
    			if ($('#savingslist').is(":hidden")) {$('#savingslist').show();}
	    		$('#savingslist').append(data);
                updateSavings();
	    	}
    	});
}
function updateCostSav() {
	$('#costUpdate').click(function(event) {
		event.preventDefault();
		var cshedID = $('#cshedID').val();
		var type = $('#savTypeSel').val();
		var dept = $('#dept').val();
		var description = $('#description').val();
		$.post('_includes/updateCost.php', {
			typeID: type,
			dept: dept,
			description: description,
			cshedID: cshedID
		}, function(data) {
			console.log(data);
			savingsRefresh();
			$('#savTypeSel').val('0');
			$('#dept').val('');
			$('#description').val('');
		});
	});
}
function newCostSav() {
	$('#newCostSav').click(function(click) {
		event.preventDefault();
		var cono = $('#conoCost').html();
		var custno = $('#custnoCost').html();
		var type = $('#savTypeSel').val();
		var dept = $('#dept').val();
		var description = $('#description').val();
		$.post('_includes/updateCost.php', {
			typeID: type,
			dept: dept,
			description: description,
			cono: cono,
			custno: custno
		}, function(data) {
			console.log(data);
			savingsRefresh();
			$('#savTypeSel').val('0');
			$('#dept').val('');
			$('#description').val('');
		});
	});
}