<?php
/*
 * This file is part of DBUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\DbUnit\Constraint\DataSetIsEqual;
use PHPUnit\Framework\TestCase;

class Extensions_Database_DataSet_FilterTest extends TestCase
{
    protected $expectedDataSet;

    public function setUp()
    {
        $this->expectedDataSet = new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
            dirname(__FILE__) . '/../_files/XmlDataSets/FilteredTestFixture.xml'
        );
    }

    public function testDeprecatedFilteredDataSetConstructor()
    {
        $constraint = new DataSetIsEqual($this->expectedDataSet);
        $dataSet    = new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
            dirname(__FILE__) . '/../_files/XmlDataSets/FilteredTestComparison.xml'
        );

        $filteredDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($dataSet, [
            'table1' => ['table1_id'],
            'table2' => '*',
            'table3' => 'table3_id'
        ]);

        self::assertThat($filteredDataSet, $constraint);
    }

    public function testExcludeFilteredDataSet()
    {
        $constraint = new DataSetIsEqual($this->expectedDataSet);
        $dataSet    = new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
            dirname(__FILE__) . '/../_files/XmlDataSets/FilteredTestComparison.xml'
        );

        $filteredDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($dataSet);

        $filteredDataSet->addExcludeTables(['table2']);
        $filteredDataSet->setExcludeColumnsForTable('table1', ['table1_id']);
        $filteredDataSet->setExcludeColumnsForTable('table3', ['table3_id']);

        self::assertThat($filteredDataSet, $constraint);
    }

    public function testIncludeFilteredDataSet()
    {
        $constraint = new DataSetIsEqual($this->expectedDataSet);
        $dataSet    = new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
            dirname(__FILE__) . '/../_files/XmlDataSets/FilteredTestComparison.xml'
        );

        $filteredDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($dataSet);

        $filteredDataSet->addIncludeTables(['table1', 'table3']);
        $filteredDataSet->setIncludeColumnsForTable('table1', ['column1', 'column2', 'column3', 'column4']);
        $filteredDataSet->setIncludeColumnsForTable('table3', ['column9', 'column10', 'column11', 'column12']);

        self::assertThat($filteredDataSet, $constraint);
    }

    public function testIncludeExcludeMixedDataSet()
    {
        $constraint = new DataSetIsEqual($this->expectedDataSet);
        $dataSet    = new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
            dirname(__FILE__) . '/../_files/XmlDataSets/FilteredTestComparison.xml'
        );

        $filteredDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($dataSet);

        $filteredDataSet->addIncludeTables(['table1', 'table3']);
        $filteredDataSet->setExcludeColumnsForTable('table1', ['table1_id']);
        $filteredDataSet->setIncludeColumnsForTable('table3', ['column9', 'column10', 'column11', 'column12']);

        self::assertThat($filteredDataSet, $constraint);
    }
}
