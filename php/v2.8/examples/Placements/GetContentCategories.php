<?php
/*
 * Copyright 2017 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// Require the base class.
require_once dirname(__DIR__) . '/BaseExample.php';

/**
 * This example displays all available content categories.
 */
class GetContentCategories extends BaseExample {
  /**
   * (non-PHPdoc)
   * @see BaseExample::getInputParameters()
   * @return array
   */
  protected function getInputParameters() {
    return [['name' => 'user_profile_id',
             'display' => 'User Profile ID',
             'required' => true]];
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::run()
   */
  public function run() {
    $values = $this->formValues;

    print '<h2>Listing all content categories</h2>';

    $response = null;
    $pageToken = null;

    $this->printResultsTableHeader('Content Categories');

    do {
      // Create and execute the content categories list request.
      $response = $this->service->contentCategories->listContentCategories(
          $values['user_profile_id'],
          ['pageToken' => $pageToken]
      );

      foreach ($response->getContentCategories() as $categories) {
        $this->printResultsTableRow($categories);
      }

      // Update the next page token.
      $pageToken = $response->getNextPageToken();
    } while(!empty($response->getContentCategories()) && !empty($pageToken));

    $this->printResultsTableFooter();
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getName()
   * @return string
   */
  public function getName() {
    return 'Get All Content Categories';
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getResultsTableHeaders()
   * @return array
   */
  public function getResultsTableHeaders() {
    return ['id' => 'Content Category ID',
            'name' => 'Content Category Name'];
  }
}
