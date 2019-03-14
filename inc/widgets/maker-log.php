<?php
// register Foo_Widget widget
function register_maker_log_widget() {
    register_widget( 'MakerLogWidget' );
}
add_action( 'widgets_init', 'register_maker_log_widget' );


class MakerLogWidget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'maker_log',
			'description' => 'Latest Maker Logs',
		);
		parent::__construct( 'maker_log', 'Maker Log', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$logs = get_posts([
			'post_type' => 'maker_log',
			'posts_per_page' => 5,
		]);
		$log_count = wp_count_posts('maker_logs');

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		if ( ! empty( $instance['intro_text'] ) ) {
			echo '<p class="small">' . $instance['intro_text'] . '</p>';
		}

		if ( ! empty( $logs ) ) {
		?>

			<ul>
				<?php foreach ( $logs as $log ) : ?>
					<li><?php echo $log->post_title; ?></li>
				<?php endforeach; ?>
			</ul>

		<?php
		}
		echo $args['after_widget'];

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Maker log', 'rosswintle' );
		$intro_text = ! empty( $instance['intro_text'] ) ? $instance['intro_text'] : esc_html__( 'Things I\'m making and doing', 'rosswintle' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'rosswintle' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'intro_text' ) ); ?>"><?php esc_attr_e( 'Intro text:', 'rosswintle' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'intro_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'intro_text' ) ); ?>" type="text" value="<?php echo esc_attr( $intro_text ); ?>">
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['intro_text'] = ( ! empty( $new_instance['intro_text'] ) ) ? sanitize_text_field( $new_instance['intro_text'] ) : '';

		return $instance;
	}
}
