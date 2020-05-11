<?php

declare(strict_types=1);

/**
 * @copyright 2020 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author 2020 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OCP\Search;

/**
 * Interface for an app search providers
 *
 * These providers will be implemented in apps, so they can participate in the
 * global search results of Nextcloud.
 *
 * @since 20.0.0
 */
interface IProvider {

	/**
	 * Find matching search entries in an app
	 *
	 * Search results can either be a complete list of all the matches the app can
	 * find, or ideally a paginated result set where more data can be fetched on
	 * demand. To be able to tell where the next offset starts the search uses
	 * "cursors" which are a property of the last result entry. E.g. search results
	 * that show most recent entries first can look for entries older than the last
	 * one of the first result set. This approach was chosen over a numeric limit/
	 * offset approach as the offset moves as new data comes in. The cursor is
	 * resistant to these changes and will still show results without overlaps or
	 * gaps. Implementations that return result pages have to adhere to the limit
	 * property of a search query.
	 *
	 * @param ISearchQuery $query
	 *
	 * @return SearchResult
	 */
	public function search(ISearchQuery $query): SearchResult;

}