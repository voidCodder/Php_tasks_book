document.addEventListener("DOMContentLoaded", function() {

	/**
	 * If checkbox checked - decorate
	 */
	$('[data-type-checkbox]').on('change', function () {
		let id = $(this).data('id')
		if ($(this).is(':checked')) {
			$(`[data-type-task][data-id=${id}]`).css('background-color', 'lightgoldenrodyellow')
		} else {
			$(`[data-type-task][data-id=${id}]`).css('background-color', 'white')
		}
	})

 /**
 * @param {HTMLElement} element Элемент, имя тэга которого будет заменено.
 * @param {String} newTag Новое имя тэга.
 */
	function replaceTag( element, newTag ){
    var elementNew = document.createElement( newTag );
    elementNew.innerHTML = element.innerHTML;

    Array.prototype.forEach.call( element.attributes, function( attr ) {
        elementNew.setAttribute( attr.name, attr.value );
    });

    element.parentNode.insertBefore( elementNew, element );
    element.parentNode.removeChild( element );
    return elementNew;
	}
	
	/**
	 * Edit button
	 */
	$('[data-event-edit]').on('click', function() {
		let id = $(this).data('id') 
		let replaceEl = $(`[data-task-description][data-id=${id}]`)
		replaceTag(replaceEl[0], 'textarea')
		$(`[data-task-description][data-id=${id}]`).attr('rows', 3).addClass('form-control')
	})

	/**
	 * Save button
	 */
	$('[data-event-save]').on('click', function() {
		let id = $(this).data('id') 
		let element = $(`[data-task-description][data-id=${id}]`)
		let elementText = $(`[data-task-description][data-id=${id}]`)[0].value
		let checked = $('#CheckTask1').prop('checked')

		let task = {
			id,
			elementText,
			status: checked
		}
		let url = '/phpActions/EditTask.php'
		fetch(url, {
			method: 'POST',
			body: JSON.stringify(task),
			headers: {
				'Content-Type': 'application/json;charset=utf-8'
			}
		})
			.then(
				element.removeAttr('rows').removeClass('form-control'),
				replaceTag(element[0], 'div'),
				$(`[data-task-description][data-id=${id}]`).html(elementText) 
			)
			.catch((error) => alert(error))
	})
	
});