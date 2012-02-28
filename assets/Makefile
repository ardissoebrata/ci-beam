BOOTSTRAP_LESS = ./less/bootstrap.less
BOOTSTRAP_RESPONSIVE_LESS = ./less/responsive.less

.PHONY: bootstrap

bootstrap : 
	mkdir -p ./css
	lessc ${BOOTSTRAP_LESS} > ./css/bootstrap.css
	lessc --compress ${BOOTSTRAP_LESS} > ./css/bootstrap.min.css
	lessc ${BOOTSTRAP_RESPONSIVE_LESS} > ./css/bootstrap-responsive.css
	lessc --compress ${BOOTSTRAP_RESPONSIVE_LESS} > ./css/bootstrap-responsive.min.css
	mkdir -p ./js
	cat js-source/bootstrap-transition.js js-source/bootstrap-alert.js js-source/bootstrap-button.js js-source/bootstrap-carousel.js js-source/bootstrap-collapse.js js-source/bootstrap-dropdown.js js-source/bootstrap-modal.js js-source/bootstrap-tooltip.js js-source/bootstrap-popover.js js-source/bootstrap-scrollspy.js js-source/bootstrap-tab.js js-source/bootstrap-typeahead.js > js/bootstrap.js
	uglifyjs -nc js/bootstrap.js > js/bootstrap.min.js
