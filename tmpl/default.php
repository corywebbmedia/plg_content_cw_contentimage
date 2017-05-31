<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if($image): ?>
    <img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" />
<?php endif;
