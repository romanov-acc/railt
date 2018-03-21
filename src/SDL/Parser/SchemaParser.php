<?php
/**
 * This file is part of Parser package.
 * 
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Parser;

use Railt\Compiler\Parser\Runtime as SchemaParserRuntime;

/**
 * This class has been auto-generated by the Railt\Compiler\Generator
 */
final class SchemaParser extends SchemaParserRuntime
{
    public function __construct()
    {
        $lexer = new \Railt\SDL\Parser\SchemaLexer();

        parent::__construct($lexer, $this->getRules());
    }

    /**
     * @return \Railt\Compiler\Parser\Rule\Rule[]
     */
    public function getRules(): array
    {
        return [
            0 =>
new \Railt\Compiler\Parser\Rule\Repetition(0, 0, -1, 'Directive', null),
            1 =>
new \Railt\Compiler\Parser\Rule\Repetition(1, 0, -1, 'Definition', null),
            'Document' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Document', [0,1,], '#Document'),
            'Definition' =>
new \Railt\Compiler\Parser\Rule\Choice('Definition', ['ObjectDefinition','InterfaceDefinition','EnumDefinition','UnionDefinition','SchemaDefinition','ScalarDefinition','InputDefinition','ExtendDefinition','DirectiveDefinition',], null),
            4 =>
new \Railt\Compiler\Parser\Rule\Terminal(4, 'T_BOOL_TRUE', null, true),
            5 =>
new \Railt\Compiler\Parser\Rule\Terminal(5, 'T_BOOL_FALSE', null, true),
            6 =>
new \Railt\Compiler\Parser\Rule\Terminal(6, 'T_NULL', null, true),
            'ValueKeyword' =>
new \Railt\Compiler\Parser\Rule\Choice('ValueKeyword', [4,5,6,], null),
            8 =>
new \Railt\Compiler\Parser\Rule\Terminal(8, 'T_ON', null, true),
            9 =>
new \Railt\Compiler\Parser\Rule\Terminal(9, 'T_TYPE', null, true),
            10 =>
new \Railt\Compiler\Parser\Rule\Terminal(10, 'T_TYPE_IMPLEMENTS', null, true),
            11 =>
new \Railt\Compiler\Parser\Rule\Terminal(11, 'T_ENUM', null, true),
            12 =>
new \Railt\Compiler\Parser\Rule\Terminal(12, 'T_UNION', null, true),
            13 =>
new \Railt\Compiler\Parser\Rule\Terminal(13, 'T_INTERFACE', null, true),
            14 =>
new \Railt\Compiler\Parser\Rule\Terminal(14, 'T_SCHEMA', null, true),
            15 =>
new \Railt\Compiler\Parser\Rule\Terminal(15, 'T_SCHEMA_QUERY', null, true),
            16 =>
new \Railt\Compiler\Parser\Rule\Terminal(16, 'T_SCHEMA_MUTATION', null, true),
            17 =>
new \Railt\Compiler\Parser\Rule\Terminal(17, 'T_SCHEMA_SUBSCRIPTION', null, true),
            18 =>
new \Railt\Compiler\Parser\Rule\Terminal(18, 'T_SCALAR', null, true),
            19 =>
new \Railt\Compiler\Parser\Rule\Terminal(19, 'T_DIRECTIVE', null, true),
            20 =>
new \Railt\Compiler\Parser\Rule\Terminal(20, 'T_INPUT', null, true),
            21 =>
new \Railt\Compiler\Parser\Rule\Terminal(21, 'T_EXTEND', null, true),
            'Keyword' =>
new \Railt\Compiler\Parser\Rule\Choice('Keyword', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,], null),
            'Number' =>
new \Railt\Compiler\Parser\Rule\Terminal('Number', 'T_NUMBER_VALUE', null, true),
            'Nullable' =>
new \Railt\Compiler\Parser\Rule\Terminal('Nullable', 'T_NULL', null, true),
            25 =>
new \Railt\Compiler\Parser\Rule\Terminal(25, 'T_BOOL_TRUE', null, true),
            26 =>
new \Railt\Compiler\Parser\Rule\Terminal(26, 'T_BOOL_FALSE', null, true),
            'Boolean' =>
new \Railt\Compiler\Parser\Rule\Choice('Boolean', [25,26,], null),
            28 =>
new \Railt\Compiler\Parser\Rule\Terminal(28, 'T_MULTILINE_STRING', null, true),
            29 =>
new \Railt\Compiler\Parser\Rule\Terminal(29, 'T_STRING', null, true),
            'String' =>
new \Railt\Compiler\Parser\Rule\Choice('String', [28,29,], null),
            31 =>
new \Railt\Compiler\Parser\Rule\Terminal(31, 'T_NAME', null, true),
            'Word' =>
new \Railt\Compiler\Parser\Rule\Choice('Word', [31,'ValueKeyword',], null),
            33 =>
new \Railt\Compiler\Parser\Rule\Terminal(33, 'T_SCHEMA_QUERY', null, true),
            34 =>
new \Railt\Compiler\Parser\Rule\Concatenation(34, [33,], '#Name'),
            35 =>
new \Railt\Compiler\Parser\Rule\Terminal(35, 'T_SCHEMA_MUTATION', null, true),
            36 =>
new \Railt\Compiler\Parser\Rule\Concatenation(36, [35,], '#Name'),
            37 =>
new \Railt\Compiler\Parser\Rule\Terminal(37, 'T_SCHEMA_SUBSCRIPTION', null, true),
            38 =>
new \Railt\Compiler\Parser\Rule\Concatenation(38, [37,], '#Name'),
            39 =>
new \Railt\Compiler\Parser\Rule\Concatenation(39, ['Word',], '#Name'),
            'Name' =>
new \Railt\Compiler\Parser\Rule\Choice('Name', [34,36,38,39,], null),
            41 =>
new \Railt\Compiler\Parser\Rule\Choice(41, ['String','Word','Keyword',], null),
            'Key' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Key', [41,], '#Name'),
            43 =>
new \Railt\Compiler\Parser\Rule\Choice(43, ['String','Number','Nullable','Keyword','Object','List','Word',], null),
            'Value' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Value', [43,], '#Value'),
            'ValueDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ValueDefinition', ['ValueDefinitionResolver',], null),
            46 =>
new \Railt\Compiler\Parser\Rule\Terminal(46, 'T_NON_NULL', null, true),
            47 =>
new \Railt\Compiler\Parser\Rule\Repetition(47, 0, 1, 46, null),
            48 =>
new \Railt\Compiler\Parser\Rule\Concatenation(48, ['ValueListDefinition',47,], '#List'),
            49 =>
new \Railt\Compiler\Parser\Rule\Terminal(49, 'T_NON_NULL', null, true),
            50 =>
new \Railt\Compiler\Parser\Rule\Repetition(50, 0, 1, 49, null),
            51 =>
new \Railt\Compiler\Parser\Rule\Concatenation(51, ['ValueScalarDefinition',50,], '#Type'),
            'ValueDefinitionResolver' =>
new \Railt\Compiler\Parser\Rule\Choice('ValueDefinitionResolver', [48,51,], null),
            53 =>
new \Railt\Compiler\Parser\Rule\Terminal(53, 'T_BRACKET_OPEN', null, false),
            54 =>
new \Railt\Compiler\Parser\Rule\Terminal(54, 'T_NON_NULL', null, true),
            55 =>
new \Railt\Compiler\Parser\Rule\Repetition(55, 0, 1, 54, null),
            56 =>
new \Railt\Compiler\Parser\Rule\Concatenation(56, ['ValueScalarDefinition',55,], '#Type'),
            57 =>
new \Railt\Compiler\Parser\Rule\Terminal(57, 'T_BRACKET_CLOSE', null, false),
            'ValueListDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ValueListDefinition', [53,56,57,], null),
            'ValueScalarDefinition' =>
new \Railt\Compiler\Parser\Rule\Choice('ValueScalarDefinition', ['Keyword','Word',], null),
            60 =>
new \Railt\Compiler\Parser\Rule\Terminal(60, 'T_BRACE_OPEN', null, false),
            61 =>
new \Railt\Compiler\Parser\Rule\Repetition(61, 0, -1, 'ObjectPair', null),
            62 =>
new \Railt\Compiler\Parser\Rule\Terminal(62, 'T_BRACE_CLOSE', null, false),
            'Object' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Object', [60,61,62,], '#Object'),
            64 =>
new \Railt\Compiler\Parser\Rule\Terminal(64, 'T_COLON', null, false),
            'ObjectPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectPair', ['Key',64,'Value',], '#ObjectPair'),
            66 =>
new \Railt\Compiler\Parser\Rule\Terminal(66, 'T_BRACKET_OPEN', null, false),
            67 =>
new \Railt\Compiler\Parser\Rule\Repetition(67, 0, -1, 'Value', null),
            68 =>
new \Railt\Compiler\Parser\Rule\Terminal(68, 'T_BRACKET_CLOSE', null, false),
            'List' =>
new \Railt\Compiler\Parser\Rule\Concatenation('List', [66,67,68,], '#List'),
            70 =>
new \Railt\Compiler\Parser\Rule\Terminal(70, 'T_MULTILINE_STRING', null, true),
            'Documentation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Documentation', [70,], '#Description'),
            72 =>
new \Railt\Compiler\Parser\Rule\Repetition(72, 0, 1, 'Documentation', null),
            73 =>
new \Railt\Compiler\Parser\Rule\Terminal(73, 'T_SCHEMA', null, true),
            74 =>
new \Railt\Compiler\Parser\Rule\Repetition(74, 0, 1, 'Name', null),
            75 =>
new \Railt\Compiler\Parser\Rule\Repetition(75, 0, -1, 'Directive', null),
            76 =>
new \Railt\Compiler\Parser\Rule\Terminal(76, 'T_BRACE_OPEN', null, false),
            77 =>
new \Railt\Compiler\Parser\Rule\Terminal(77, 'T_BRACE_CLOSE', null, false),
            'SchemaDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinition', [72,73,74,75,76,'SchemaDefinitionBody',77,], '#SchemaDefinition'),
            79 =>
new \Railt\Compiler\Parser\Rule\Choice(79, ['SchemaDefinitionQuery','SchemaDefinitionMutation','SchemaDefinitionSubscription',], null),
            'SchemaDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Repetition('SchemaDefinitionBody', 0, -1, 79, null),
            81 =>
new \Railt\Compiler\Parser\Rule\Repetition(81, 0, 1, 'Documentation', null),
            82 =>
new \Railt\Compiler\Parser\Rule\Terminal(82, 'T_SCHEMA_QUERY', null, false),
            83 =>
new \Railt\Compiler\Parser\Rule\Terminal(83, 'T_COLON', null, false),
            'SchemaDefinitionQuery' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionQuery', [81,82,83,'SchemaDefinitionFieldValue',], '#Query'),
            85 =>
new \Railt\Compiler\Parser\Rule\Repetition(85, 0, 1, 'Documentation', null),
            86 =>
new \Railt\Compiler\Parser\Rule\Terminal(86, 'T_SCHEMA_MUTATION', null, false),
            87 =>
new \Railt\Compiler\Parser\Rule\Terminal(87, 'T_COLON', null, false),
            'SchemaDefinitionMutation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionMutation', [85,86,87,'SchemaDefinitionFieldValue',], '#Mutation'),
            89 =>
new \Railt\Compiler\Parser\Rule\Repetition(89, 0, 1, 'Documentation', null),
            90 =>
new \Railt\Compiler\Parser\Rule\Terminal(90, 'T_SCHEMA_SUBSCRIPTION', null, false),
            91 =>
new \Railt\Compiler\Parser\Rule\Terminal(91, 'T_COLON', null, false),
            'SchemaDefinitionSubscription' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionSubscription', [89,90,91,'SchemaDefinitionFieldValue',], '#Subscription'),
            93 =>
new \Railt\Compiler\Parser\Rule\Repetition(93, 0, -1, 'Directive', null),
            'SchemaDefinitionFieldValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionFieldValue', ['ValueDefinition',93,], null),
            95 =>
new \Railt\Compiler\Parser\Rule\Repetition(95, 0, 1, 'Documentation', null),
            96 =>
new \Railt\Compiler\Parser\Rule\Terminal(96, 'T_SCALAR', null, false),
            97 =>
new \Railt\Compiler\Parser\Rule\Repetition(97, 0, -1, 'Directive', null),
            'ScalarDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ScalarDefinition', [95,96,'Name',97,], '#ScalarDefinition'),
            99 =>
new \Railt\Compiler\Parser\Rule\Repetition(99, 0, 1, 'Documentation', null),
            100 =>
new \Railt\Compiler\Parser\Rule\Terminal(100, 'T_INPUT', null, false),
            101 =>
new \Railt\Compiler\Parser\Rule\Repetition(101, 0, -1, 'Directive', null),
            102 =>
new \Railt\Compiler\Parser\Rule\Terminal(102, 'T_BRACE_OPEN', null, false),
            103 =>
new \Railt\Compiler\Parser\Rule\Repetition(103, 0, -1, 'InputDefinitionField', null),
            104 =>
new \Railt\Compiler\Parser\Rule\Terminal(104, 'T_BRACE_CLOSE', null, false),
            'InputDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinition', [99,100,'Name',101,102,103,104,], '#InputDefinition'),
            106 =>
new \Railt\Compiler\Parser\Rule\Repetition(106, 0, 1, 'Documentation', null),
            107 =>
new \Railt\Compiler\Parser\Rule\Terminal(107, 'T_COLON', null, false),
            108 =>
new \Railt\Compiler\Parser\Rule\Repetition(108, 0, 1, 'InputDefinitionDefaultValue', null),
            109 =>
new \Railt\Compiler\Parser\Rule\Repetition(109, 0, -1, 'Directive', null),
            110 =>
new \Railt\Compiler\Parser\Rule\Concatenation(110, ['Key',107,'ValueDefinition',108,109,], null),
            'InputDefinitionField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionField', [106,110,], '#Argument'),
            112 =>
new \Railt\Compiler\Parser\Rule\Terminal(112, 'T_EQUAL', null, false),
            'InputDefinitionDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionDefaultValue', [112,'Value',], null),
            114 =>
new \Railt\Compiler\Parser\Rule\Repetition(114, 0, 1, 'Documentation', null),
            115 =>
new \Railt\Compiler\Parser\Rule\Terminal(115, 'T_EXTEND', null, false),
            116 =>
new \Railt\Compiler\Parser\Rule\Concatenation(116, ['ObjectDefinition',], '#ExtendDefinition'),
            117 =>
new \Railt\Compiler\Parser\Rule\Concatenation(117, ['InterfaceDefinition',], '#ExtendDefinition'),
            118 =>
new \Railt\Compiler\Parser\Rule\Concatenation(118, ['EnumDefinition',], '#ExtendDefinition'),
            119 =>
new \Railt\Compiler\Parser\Rule\Concatenation(119, ['UnionDefinition',], '#ExtendDefinition'),
            120 =>
new \Railt\Compiler\Parser\Rule\Concatenation(120, ['SchemaDefinition',], '#ExtendDefinition'),
            121 =>
new \Railt\Compiler\Parser\Rule\Concatenation(121, ['ScalarDefinition',], '#ExtendDefinition'),
            122 =>
new \Railt\Compiler\Parser\Rule\Concatenation(122, ['InputDefinition',], '#ExtendDefinition'),
            123 =>
new \Railt\Compiler\Parser\Rule\Concatenation(123, ['DirectiveDefinition',], '#ExtendDefinition'),
            124 =>
new \Railt\Compiler\Parser\Rule\Choice(124, [116,117,118,119,120,121,122,123,], null),
            'ExtendDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ExtendDefinition', [114,115,124,], null),
            126 =>
new \Railt\Compiler\Parser\Rule\Repetition(126, 0, 1, 'Documentation', null),
            127 =>
new \Railt\Compiler\Parser\Rule\Terminal(127, 'T_DIRECTIVE', null, false),
            128 =>
new \Railt\Compiler\Parser\Rule\Terminal(128, 'T_DIRECTIVE_AT', null, false),
            129 =>
new \Railt\Compiler\Parser\Rule\Repetition(129, 0, -1, 'DirectiveDefinitionArguments', null),
            130 =>
new \Railt\Compiler\Parser\Rule\Terminal(130, 'T_ON', null, false),
            131 =>
new \Railt\Compiler\Parser\Rule\Repetition(131, 1, -1, 'DirectiveDefinitionTargets', null),
            'DirectiveDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinition', [126,127,128,'Name',129,130,131,], '#DirectiveDefinition'),
            133 =>
new \Railt\Compiler\Parser\Rule\Terminal(133, 'T_PARENTHESIS_OPEN', null, false),
            134 =>
new \Railt\Compiler\Parser\Rule\Repetition(134, 0, -1, 'DirectiveDefinitionArgument', null),
            135 =>
new \Railt\Compiler\Parser\Rule\Terminal(135, 'T_PARENTHESIS_CLOSE', null, false),
            'DirectiveDefinitionArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionArguments', [133,134,135,], null),
            137 =>
new \Railt\Compiler\Parser\Rule\Repetition(137, 0, 1, 'Documentation', null),
            138 =>
new \Railt\Compiler\Parser\Rule\Terminal(138, 'T_COLON', null, false),
            139 =>
new \Railt\Compiler\Parser\Rule\Repetition(139, 0, 1, 'DirectiveDefinitionDefaultValue', null),
            140 =>
new \Railt\Compiler\Parser\Rule\Repetition(140, 0, -1, 'Directive', null),
            'DirectiveDefinitionArgument' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionArgument', [137,'Key',138,'ValueDefinition',139,140,], '#Argument'),
            142 =>
new \Railt\Compiler\Parser\Rule\Terminal(142, 'T_OR', null, false),
            143 =>
new \Railt\Compiler\Parser\Rule\Concatenation(143, [142,'Key',], null),
            144 =>
new \Railt\Compiler\Parser\Rule\Repetition(144, 0, -1, 143, null),
            'DirectiveDefinitionTargets' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionTargets', ['Key',144,], '#Target'),
            146 =>
new \Railt\Compiler\Parser\Rule\Terminal(146, 'T_EQUAL', null, false),
            'DirectiveDefinitionDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionDefaultValue', [146,'Value',], null),
            148 =>
new \Railt\Compiler\Parser\Rule\Repetition(148, 0, 1, 'Documentation', null),
            149 =>
new \Railt\Compiler\Parser\Rule\Terminal(149, 'T_TYPE', null, false),
            150 =>
new \Railt\Compiler\Parser\Rule\Repetition(150, 0, 1, 'ObjectDefinitionImplements', null),
            151 =>
new \Railt\Compiler\Parser\Rule\Repetition(151, 0, -1, 'Directive', null),
            152 =>
new \Railt\Compiler\Parser\Rule\Terminal(152, 'T_BRACE_OPEN', null, false),
            153 =>
new \Railt\Compiler\Parser\Rule\Repetition(153, 0, -1, 'ObjectDefinitionField', null),
            154 =>
new \Railt\Compiler\Parser\Rule\Terminal(154, 'T_BRACE_CLOSE', null, false),
            'ObjectDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinition', [148,149,'Name',150,151,152,153,154,], '#ObjectDefinition'),
            156 =>
new \Railt\Compiler\Parser\Rule\Terminal(156, 'T_TYPE_IMPLEMENTS', null, false),
            157 =>
new \Railt\Compiler\Parser\Rule\Repetition(157, 0, -1, 'Key', null),
            158 =>
new \Railt\Compiler\Parser\Rule\Terminal(158, 'T_AND', null, false),
            159 =>
new \Railt\Compiler\Parser\Rule\Concatenation(159, [158,'Key',], null),
            160 =>
new \Railt\Compiler\Parser\Rule\Repetition(160, 0, 1, 159, null),
            'ObjectDefinitionImplements' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionImplements', [156,157,160,], '#Implements'),
            162 =>
new \Railt\Compiler\Parser\Rule\Repetition(162, 0, 1, 'Documentation', null),
            163 =>
new \Railt\Compiler\Parser\Rule\Repetition(163, 0, 1, 'Arguments', null),
            164 =>
new \Railt\Compiler\Parser\Rule\Terminal(164, 'T_COLON', null, false),
            165 =>
new \Railt\Compiler\Parser\Rule\Concatenation(165, ['Key',163,164,'ObjectDefinitionFieldValue',], null),
            'ObjectDefinitionField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionField', [162,165,], '#Field'),
            167 =>
new \Railt\Compiler\Parser\Rule\Repetition(167, 0, -1, 'Directive', null),
            'ObjectDefinitionFieldValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionFieldValue', ['ValueDefinition',167,], null),
            169 =>
new \Railt\Compiler\Parser\Rule\Repetition(169, 0, 1, 'Documentation', null),
            170 =>
new \Railt\Compiler\Parser\Rule\Terminal(170, 'T_INTERFACE', null, false),
            171 =>
new \Railt\Compiler\Parser\Rule\Repetition(171, 0, -1, 'Directive', null),
            172 =>
new \Railt\Compiler\Parser\Rule\Terminal(172, 'T_BRACE_OPEN', null, false),
            173 =>
new \Railt\Compiler\Parser\Rule\Repetition(173, 0, -1, 'InterfaceDefinitionBody', null),
            174 =>
new \Railt\Compiler\Parser\Rule\Terminal(174, 'T_BRACE_CLOSE', null, false),
            'InterfaceDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinition', [169,170,'Name',171,172,173,174,], '#InterfaceDefinition'),
            176 =>
new \Railt\Compiler\Parser\Rule\Terminal(176, 'T_COLON', null, false),
            177 =>
new \Railt\Compiler\Parser\Rule\Repetition(177, 0, -1, 'Directive', null),
            178 =>
new \Railt\Compiler\Parser\Rule\Concatenation(178, ['InterfaceDefinitionFieldKey',176,'ValueDefinition',177,], null),
            'InterfaceDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionBody', [178,], '#Field'),
            180 =>
new \Railt\Compiler\Parser\Rule\Repetition(180, 0, 1, 'Documentation', null),
            181 =>
new \Railt\Compiler\Parser\Rule\Repetition(181, 0, 1, 'Arguments', null),
            'InterfaceDefinitionFieldKey' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionFieldKey', [180,'Key',181,], null),
            183 =>
new \Railt\Compiler\Parser\Rule\Repetition(183, 0, 1, 'Documentation', null),
            184 =>
new \Railt\Compiler\Parser\Rule\Terminal(184, 'T_ENUM', null, false),
            185 =>
new \Railt\Compiler\Parser\Rule\Repetition(185, 0, -1, 'Directive', null),
            186 =>
new \Railt\Compiler\Parser\Rule\Terminal(186, 'T_BRACE_OPEN', null, false),
            187 =>
new \Railt\Compiler\Parser\Rule\Repetition(187, 0, -1, 'EnumField', null),
            188 =>
new \Railt\Compiler\Parser\Rule\Terminal(188, 'T_BRACE_CLOSE', null, false),
            'EnumDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumDefinition', [183,184,'Name',185,186,187,188,], '#EnumDefinition'),
            190 =>
new \Railt\Compiler\Parser\Rule\Repetition(190, 0, 1, 'Documentation', null),
            191 =>
new \Railt\Compiler\Parser\Rule\Repetition(191, 0, -1, 'Directive', null),
            192 =>
new \Railt\Compiler\Parser\Rule\Concatenation(192, ['EnumValue',191,], null),
            'EnumField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumField', [190,192,], '#Value'),
            194 =>
new \Railt\Compiler\Parser\Rule\Terminal(194, 'T_NAME', null, true),
            195 =>
new \Railt\Compiler\Parser\Rule\Choice(195, [194,'Keyword',], null),
            'EnumValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumValue', [195,], '#Name'),
            197 =>
new \Railt\Compiler\Parser\Rule\Repetition(197, 0, 1, 'Documentation', null),
            198 =>
new \Railt\Compiler\Parser\Rule\Terminal(198, 'T_UNION', null, false),
            199 =>
new \Railt\Compiler\Parser\Rule\Repetition(199, 0, -1, 'Directive', null),
            200 =>
new \Railt\Compiler\Parser\Rule\Terminal(200, 'T_EQUAL', null, false),
            'UnionDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionDefinition', [197,198,'Name',199,200,'UnionBody',], '#UnionDefinition'),
            202 =>
new \Railt\Compiler\Parser\Rule\Terminal(202, 'T_OR', null, false),
            203 =>
new \Railt\Compiler\Parser\Rule\Repetition(203, 0, 1, 202, null),
            204 =>
new \Railt\Compiler\Parser\Rule\Repetition(204, 1, -1, 'UnionUnitesList', null),
            'UnionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionBody', [203,204,], '#Relations'),
            206 =>
new \Railt\Compiler\Parser\Rule\Terminal(206, 'T_OR', null, false),
            207 =>
new \Railt\Compiler\Parser\Rule\Concatenation(207, [206,'Name',], null),
            208 =>
new \Railt\Compiler\Parser\Rule\Repetition(208, 0, -1, 207, null),
            'UnionUnitesList' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionUnitesList', ['Name',208,], null),
            210 =>
new \Railt\Compiler\Parser\Rule\Terminal(210, 'T_PARENTHESIS_OPEN', null, false),
            211 =>
new \Railt\Compiler\Parser\Rule\Repetition(211, 0, -1, 'ArgumentPair', null),
            212 =>
new \Railt\Compiler\Parser\Rule\Terminal(212, 'T_PARENTHESIS_CLOSE', null, false),
            'Arguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Arguments', [210,211,212,], null),
            214 =>
new \Railt\Compiler\Parser\Rule\Repetition(214, 0, 1, 'Documentation', null),
            215 =>
new \Railt\Compiler\Parser\Rule\Terminal(215, 'T_COLON', null, false),
            216 =>
new \Railt\Compiler\Parser\Rule\Repetition(216, 0, 1, 'ArgumentDefaultValue', null),
            217 =>
new \Railt\Compiler\Parser\Rule\Repetition(217, 0, -1, 'Directive', null),
            'ArgumentPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentPair', [214,'Key',215,'ValueDefinition',216,217,], '#Argument'),
            'ArgumentValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentValue', ['ValueDefinition',], '#Type'),
            220 =>
new \Railt\Compiler\Parser\Rule\Terminal(220, 'T_EQUAL', null, false),
            'ArgumentDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentDefaultValue', [220,'Value',], null),
            222 =>
new \Railt\Compiler\Parser\Rule\Terminal(222, 'T_DIRECTIVE_AT', null, false),
            223 =>
new \Railt\Compiler\Parser\Rule\Repetition(223, 0, 1, 'DirectiveArguments', null),
            'Directive' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Directive', [222,'Name',223,], '#Directive'),
            225 =>
new \Railt\Compiler\Parser\Rule\Terminal(225, 'T_PARENTHESIS_OPEN', null, false),
            226 =>
new \Railt\Compiler\Parser\Rule\Repetition(226, 0, -1, 'DirectiveArgumentPair', null),
            227 =>
new \Railt\Compiler\Parser\Rule\Terminal(227, 'T_PARENTHESIS_CLOSE', null, false),
            'DirectiveArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveArguments', [225,226,227,], null),
            229 =>
new \Railt\Compiler\Parser\Rule\Terminal(229, 'T_COLON', null, false),
            'DirectiveArgumentPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveArgumentPair', ['Key',229,'Value',], '#Argument'),
                    ];
    }

    /**
     * @return string Returns the lexer compilation date and time in RFC3339 format
     */
    public function getBuiltDate(): string
    {
        return '2018-03-21UTC22:59:15.198+00:00';
    }
}
