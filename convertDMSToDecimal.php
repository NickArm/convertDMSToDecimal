	function convertDMSToDecimal($dms) {
		// Handle null or unexpected values gracefully
		if ($dms === '\N' || $dms === null || trim($dms) === '') {
			return false; // Return false for invalid or empty values
		}

		$length = strlen($dms);
		
		if ($length === 5) {
			// Format is DDMMX (for latitudes) or DMMMX (for small longitudes)
			$degrees = substr($dms, 0, 2); // Two digits for degrees
			$minutes = substr($dms, 2, 2);
			$direction = substr($dms, 4, 1);
		} elseif ($length === 6) {
			// Format is DDDMMX (for longitudes with three-digit degrees)
			$degrees = substr($dms, 0, 3); // Three digits for degrees
			$minutes = substr($dms, 3, 2);
			$direction = substr($dms, 5, 1);
		} else {
			// If the format is unexpected, return false
			return false;
		}

		$decimal = $degrees + ($minutes / 60);

		// If the direction is South or West, make the value negative
		if ($direction == 'S' || $direction == 'W') {
			$decimal *= -1;
		}

		return $decimal;
	}
