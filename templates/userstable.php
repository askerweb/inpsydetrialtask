<?php
/**
 * InspydeAskerweb WordPress Plugin Template
 * php version 7.4
 *
 * @category WP_Plugin_Template
 * @package  InspydeAskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
get_header();
?>
    <section class="userstable">
        <?php
        if (!empty($args['errors']) ) : ?>
            <div class="errors">
                <?php
                foreach ($args['errors'] as $error) {
                    ?>
                    <div class="error"><?php echo $error; ?></div>
                    <?php
                }
                ?>
            </div>
            <?php
        else:
            ?>
            <table>
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Username</td>
                </tr>
                <?php
                foreach ($args['users'] as $user):
                    ?>
                    <tr>
                        <td><a href="" class="showDetail">
                                <?php echo $user->id; ?></a></td>
                        <td><a href="" class="showDetail">
                                <?php echo  $user->name; ?></a></td>
                        <td><a href="" class="showDetail">
                                <?php echo  $user->username; ?></a></td>
                    </tr>
                    <?php
                endforeach;
                ?>
                </tbody>
            </table>
            <div class="detail_error"></div>
            <div class="detail_info">
                <div class="detail_info__id">
                    ID: <span><?php echo $args['users'][0]->id; ?></span>
                </div>
                <div class="detail_info__name">
                    Name: <span><?php echo  $args['users'][0]->name; ?></span>
                </div>
                <div class="detail_info__username">
                    Username: <span>
                        <?php echo  $args['users'][0]->username; ?>
                    </span>
                </div>
                <div class="detail_info__email">
                    Email: <span><?php echo  $args['users'][0]->email; ?></span>
                </div>
                <div class="detail_info__address">Address:
                    <span><?php echo $args['users'][0]->address->city; ?>,
                        <?php echo  $args['users'][0]->address->street; ?>
                        <?php echo $args['users'][0  ]->address->suite; ?>
                        <?php echo $args['users'][0]->address->zipcode; ?></span>
                </div>
                <div class="detail_info__latlng">Latitude and longitude:
                    <span>
                        <?php echo $args['users'][0]->address->geo->lat; ?>,
                        <?php echo  $args['users'][0]->address->geo->lng; ?>
                    </span>
                </div>
                <div class="detail_info__phone">
                    Phone: <span><?php echo  $args['users'][0]->phone; ?></span>
                </div>
                <div class="detail_info__website">
                    Website: <span><?php echo  $args['users'][0]->website; ?></span>
                </div>
                <div class="detail_info__company">
                    Company: <span>
                        <?php echo  $args['users'][0]->company->name; ?>
                    </span>
                </div>
                <div class="detail_info__company-phrase">Company phrase:
                    <span>
                        <?php echo  $args['users'][0]->company->catchPhrase; ?>
                    </span></div>
                <div class="detail_info__company-bs">
                    Company bs: <span>
                        <?php echo  $args['users'][0]->company->bs; ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php
get_footer();