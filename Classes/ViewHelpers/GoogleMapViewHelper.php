<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Sebastian Michaelsen
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Renders a Google Map for a given Job Offer
 *
 * = Examples =
 *
 * <j:googleMap jobOffer="{jobOffer}" />
 *
 * @version $Id: $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @scope prototype
 */
class Tx_Jobsearch_ViewHelpers_GoogleMapViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Renders a Google Map for a given Job Offer
	 * @param Tx_Jobsearch_Domain_Model_JobOffer $jobOffer
	 * @return string Code to display a Google Map
	 */
	public function render(Tx_Jobsearch_Domain_Model_JobOffer $jobOffer) {
		$GLOBALS['TSFE']->additionalHeaderData[] = '
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('jobsearch') . 'Resources/Public/Javascript/gmap3.js"></script>
			<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('jobsearch') . 'Resources/Public/Javascript/map.js"></script>
			<script type="text/javascript">
				$(function(){

					$.gmap3.setDefault({
						init:{
							center:{
								lat: 54.3,
								lng: 9.6
							},
							zoom: 14
						}
					});

					var coords = new google.maps.LatLng(' . $jobOffer->getStore()->getLat() . ', ' . $jobOffer->getStore()->getLon() . ');
					$("#map_canvas").gmap3(
						{
							action: ":addMarker",
							args:{
								latLng: coords,
								map:{
									center: true
								}
							}
						},
						{
							action: "enableScrollWheelZoom"
						}
					);
				});
			</script>
		';
	}
}

?>